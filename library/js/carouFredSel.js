(function($) {
    $.fn.carouFredSel = function(o) {

        if (this.length > 1) {
            return this.each(function() {
                $(this).carouFredSel(o);
            });
        }

        this.init = function() {
            direction = (opts.direction == 'up' || opts.direction == 'left') ? 'next' : 'prev';

            if ( typeof( opts.items ) !== 'object') {
                opts.items = { visible: opts.items };
            }
            if ( !opts.items.width ) {
                opts.items.width = $itm.outerWidth(true);
            }
            if ( !opts.items.height ) {
                opts.items.height = $itm.outerHeight(true);
            }

            if (typeof(opts.scroll.duration) !== 'number') {
                opts.scroll.duration = 500;
            }
            if (typeof(opts.scroll.items) !== 'number') {
                opts.scroll.items = opts.items.visible;
            }

            opts.auto = getNaviObject(opts.auto, false, true);
            opts.prev = getNaviObject(opts.prev);
            opts.next = getNaviObject(opts.next);
            opts.pagination = getNaviObject(opts.pagination, true);

            opts.auto = $.extend({}, opts.scroll, opts.auto);
            opts.prev = $.extend({}, opts.scroll, opts.prev);
            opts.next = $.extend({}, opts.scroll, opts.next);
            opts.pagination = $.extend({}, opts.scroll, opts.pagination);

            if (typeof( opts.pagination.anchorBuilder) !== 'function') {
                opts.pagination.anchorBuilder = $.fn.carouFredSel.pageAnchorBuilder;
            }
            if (typeof(opts.pagination.keys) !== 'boolean') {
                opts.pagination.keys = false;
            }
            if (typeof(opts.auto.play) !== 'boolean') {
                opts.auto.play = true;
            }
            if (typeof(opts.auto.nap) !== 'boolean') {
                opts.auto.nap = true;
            }
            if (typeof(opts.auto.delay) !== 'number') {
                opts.auto.delay = 0;
            }
            if (typeof(opts.auto.pauseDuration) !== 'number') {
                opts.auto.pauseDuration = (opts.auto.duration < 10) ? 3000 : opts.auto.duration * 6;
            }
            if (opts.auto.pauseDuration == opts.auto.duration) {
                opts.auto.duration -= 10;
            }

            return this;
        };
        /* end init */

        this.build = function() {
            $wrp.css({
                position: 'relative',
                overflow: 'hidden'
            });
            $cfs.css({
                position: 'absolute'
            });
            setSizes($wrp, $cfs, $itm, opts);
            return this;
        };
        /* end-build */

        this.bind_events = function() {
            $cfs.bind('pause', function() {
                    if (autoInterval !== null) {
                        clearTimeout(autoInterval);
                    }
                })
                .bind('play', function(e, d, f) {
                    if (opts.auto.play) {
                        if (typeof(d) == 'undefined') {
                            d = direction;
                        }
                        if (typeof(f) == 'undefined') {
                            f = 0;
                        }

                        autoInterval = setTimeout(function() {
                            if ($cfs.is(':animated')) {
                                $cfs.trigger('pause').trigger('play', d); /*    still animating, wait */
                            } else {
                                $cfs.trigger(d, opts.auto); /*    scroll */
                            }
                        }, opts.auto.pauseDuration + f);
                    }
                })
                .bind('prev', function(e, sO, nI) {
                    if ($cfs.is(':animated')) {
                        return;
                    }
                    if (opts.items.visible >= totalItems) {
                        log('Not enough items: not scrolling');
                        return;
                    }

                    if (typeof(sO) == 'number') {
                        nI  = sO;
                    }
                    if (typeof(sO) !== 'object') {
                        sO = opts.prev;
                    }
                    if (typeof(nI) !== 'number') {
                        nI = sO.items;
                    }
                    if (typeof(nI) !== 'number') {
                        log('Not a valid number: not scrolling');
                        return;
                    }

                    $cfs.find('> *:gt('+(totalItems-nI-1)+')').prependTo($cfs);

                    if (totalItems < opts.items.visible + nI) {
                        $cfs.find('> *:lt('+((opts.items.visible + nI)-totalItems)+')').clone(true).appendTo($cfs);
                    }

                    firstItem -= nI;
                    if (firstItem < 0) {
                        firstItem += totalItems;
                    }

                    var c_itm = getCurrentItems($cfs, opts, nI),
                        i_siz = getSizes(opts, c_itm[0].filter(':lt('+nI+')')),
                        w_siz = getSizes(opts, c_itm[0], true);

                    var ani = {},
                        wra = {},
                        dur = sO.duration;

                    if (dur == 'auto') {
                        dur = opts.scroll.duration / opts.scroll.items * nI;
                    } else if (dur < 10) {
                        dur = i_siz[1] / dur;
                    }

                    ani[i_siz[4]] = 0;
                    wra[i_siz[0]] =  w_siz[1];
                    wra[i_siz[2]] =  w_siz[3];

                    if (sO.onBefore) {
                        sO.onBefore(c_itm[1], c_itm[0], w_siz[1], w_siz[3], dur);
                    }

                    $wrp.animate(wra, {
                        duration: dur,
                        easing    : sO.easing
                    });
                    $cfs.data('cfs_numItems',     nI)
                        .data('cfs_slideObj',     sO)
                        .data('cfs_oldItems',     c_itm[1])
                        .data('cfs_newItems',     c_itm[0])
                        .data('cfs_w_siz1',        w_siz[1])
                        .data('cfs_w_siz2',        w_siz[3])
                        .css(i_siz[4], -i_siz[1])
                        .animate(ani, {
                            duration: dur,
                            easing    : sO.easing,
                            complete: function() {
                                if (totalItems < opts.items.visible + $cfs.data('cfs_numItems')) {
                                    $cfs.find('> *:gt('+(totalItems-1)+')').remove();
                                }
                                if ($cfs.data('cfs_slideObj').onAfter) {
                                    $cfs.data('cfs_slideObj').onAfter($cfs.data('cfs_oldItems'), $cfs.data('cfs_newItems'), $cfs.data('cfs_w_siz1'), $cfs.data('cfs_w_siz2'));
                                }
                            }
                        });

                    /*    auto-play */
                    $cfs.trigger('updatePageStatus')
                        .trigger('pause').trigger('play');
                })
                .bind('next', function(e, sO, nI) {
                    if ($cfs.is(':animated')) {
                        return;
                    }
                    if (opts.items.visible >= totalItems) {
                        log('Not enough items: not scrolling');
                        return;
                    }

                    if (typeof(sO) == 'number') {
                        nI = sO;
                    }
                    if (typeof(sO) !== 'object') {
                        sO = opts.next;
                    }
                    if (typeof(nI) !== 'number') {
                        nI = sO.items;
                    }
                    if (typeof(nI) !== 'number') {
                        log('Not a valid number: not scrolling');
                        return;
                    }

                    if (totalItems < opts.items.visible + nI) {
                        $cfs.find('> *:lt('+((opts.items.visible + nI)-totalItems)+')').clone(true).appendTo($cfs);
                    }

                    firstItem += nI;
                    if (firstItem >= totalItems) {
                        firstItem -= totalItems;
                    }

                    var c_itm = getCurrentItems($cfs, opts, nI),
                        i_siz = getSizes(opts, c_itm[0].filter(':lt('+nI+')')),
                        w_siz = getSizes(opts, c_itm[1], true);

                    var ani = {},
                        wra = {},
                        dur = sO.duration;

                    if (dur == 'auto') {
                        dur = opts.scroll.duration / opts.scroll.items * nI;
                    } else if (dur < 10) {
                        dur = i_siz[1] / dur;
                    }

                    ani[i_siz[4]] = -i_siz[1];
                    wra[i_siz[0]] =  w_siz[1];
                    wra[i_siz[2]] =  w_siz[3];

                    if (sO.onBefore) {
                        sO.onBefore(c_itm[0], c_itm[1], w_siz[1], w_siz[3], dur);
                    }

                    $wrp.animate(wra, {
                        duration: dur,
                        easing    : sO.easing
                    });
                    $cfs.data('cfs_numItems',     nI)
                        .data('cfs_slideObj',     sO)
                        .data('cfs_oldItems',     c_itm[0])
                        .data('cfs_newItems',     c_itm[1])
                        .data('cfs_w_siz1',        w_siz[1])
                        .data('cfs_w_siz2',        w_siz[3])
                        .animate(ani, {
                            duration: dur,
                            easing    : sO.easing,
                            complete: function() {
                                if ($cfs.data('cfs_slideObj').onAfter) {
                                    $cfs.data('cfs_slideObj').onAfter($cfs.data('cfs_oldItems'), $cfs.data('cfs_newItems'), $cfs.data('cfs_w_siz1'), $cfs.data('cfs_w_siz2'));
                                }
                                if (totalItems < opts.items.visible + $cfs.data('cfs_numItems')) {
                                    $cfs.find('> *:gt('+(totalItems-1)+')').remove();
                                }
                                $cfs.css(i_siz[4], 0).find('> *:lt('+$cfs.data('cfs_numItems')+')').appendTo($cfs);
                            }
                        });

                    /*    auto-play */
                    $cfs.trigger('updatePageStatus')
                        .trigger('pause').trigger('play');
                })
                .bind('scrollTo', function(e, n, d, o) {
                    if ($cfs.is(':animated')) {
                        return;
                    }

                    if (typeof(n) == 'string') {
                        n = parseInt(n);
                    }
                    if (typeof(n) == 'object') {
                        n = $cfs.find('> *').index(n);
                    } else if (typeof(n) == 'number') {
                        n += -firstItem + totalItems;
                        if (n >= totalItems) n -= totalItems;
                    }

                    if (typeof(n) !== 'number' || n == -1) {
                        log('Not a valid number.');
                        return;
                    }

                    if (typeof(d) == 'string') {
                        d = parseInt(d);
                    }
                    if (typeof(d) !== 'number') {
                        d = 0;
                    }

                    if (typeof(o) !== 'object') {
                        o = false;
                    }

                    n += d;
                    if (n < 0) {
                        n += totalItems;
                    }
                    if (n >= totalItems) {
                        n -= totalItems;
                    }
                    if (n == 0) {
                        return;
                    }

                    if (n < totalItems / 2) {
                        $cfs.trigger('next', [o, n]);
                    } else {
                        $cfs.trigger('prev', [o, totalItems-n]);
                    }
                })
                .bind('slideTo', function(e, n, d, o) {
                    $cfs.trigger('scrollTo', [n, d, o]);
                })
                .bind('insertItem', function(e, i, n) {
                    if (typeof(i) == 'string') {
                        i = $(i);
                    }
                    if (typeof(i) !== 'object' ||
                        typeof(i.jquery) == 'undefined' ||
                        i.length == 0
                    ) {
                        log('Not a valid object.');
                        return;
                    }

                    if (typeof(n) == 'undefined') {
                        n = 'after';
                    }
                    if (typeof(n) == 'number') {
                        n = n-1;
                    }
                    if (typeof(n) == 'string') {
                             if (n == 'before') {
                                n = totalItems-1;
                            }
                    } else if (n == 'after') {
                        n = opts.items.visible - 1;
                    } else if (n == 'end') {
                        n = totalItems-firstItem-1;
                    } else {
                        n = $(n);
                    }
                    if (typeof(n) == 'object') {
                        n = $cfs.find('> *').index(n)-1;
                    }
                    if (typeof(n) !== 'number') {
                        log('Not a valid number.');
                        return;
                    }

                    var nulItem = totalItems - firstItem;
                    if (nulItem >= totalItems) {
                        nulItem -= totalItems;
                    }
                    if (n >= nulItem && nulItem > 0) {
                        firstItem += i.length;
                    }

                    var $itmx = $cfs.find('> *');
                    if ($itmx.length < 2) {
                        if (n == -1)    $cfs.prepend(i);
                        else            $cfs.append(i);
                    } else {
                        if (n == -1)     $itmx.filter(':nth(0)').before(i);
                        else            $itmx.filter(':nth('+n+')').after(i);
                    }

                    $itm         = getItems($cfs);
                    totalItems     = $itm.length;

                    setSizes($wrp, $cfs, $itm, opts);
                    $cfs.trigger('updatePageStatus', true);
                })
                .bind('removeItem', function(e, i) {
                    if (typeof(i) == 'object' &&
                        typeof(i.jquery) == 'undefined') {
                        i = $(i);
                    }
                    if (typeof(i) == 'string') {
                        i = $(i);
                    }
                    if (typeof(i) == 'number') {
                        i = $cfs.find('> *:nth('+i+')');
                    }

                    if (typeof(i) !== 'object' ||
                        typeof(i.jquery) == 'undefined' ||
                        i.length == 0
                    ) {
                        log('Not a valid object.');
                        return;
                    }

                    var n = $cfs.find('> *').index(i);
                    var nulItem = totalItems - firstItem;
                    if (nulItem >= totalItems) {
                        nulItem -= totalItems;
                    }
                    if (n >= nulItem && nulItem > 0) {
                        firstItem -= i.length;
                    } else if (nulItem - i.length == 0) {
                        firstItem = 0;
                    }

                    i.remove();

                    $itm = getItems($cfs);
                    totalItems = $itm.length;

                    setSizes($wrp, $cfs, $itm, opts);
                    $cfs.trigger('updatePageStatus', true);
                })
                .bind('updatePageStatus', function(e, bpa) {
                    if (!opts.pagination.container) {
                        return false;
                    }

                    if (typeof(bpa) == 'boolean' && bpa) {
                        opts.pagination.container.find('> *').remove();
                        for (var a = 0; a < Math.ceil(totalItems/opts.items.visible); a++) {
                            opts.pagination.container.append(opts.pagination.anchorBuilder(a+1));
                        }
                        opts.pagination.container.find('> *').each(function(a) {
                            $(this).unbind('click').click(function() {
                                $cfs.trigger('scrollTo', [a * opts.items.visible, 0, opts.pagination]);
                                return false;
                            });
                        });
                    }

                    var nr = Math.round(firstItem / opts.items.visible);
                    opts.pagination.container.find('> *')
                        .removeClass('selected')
                        .filter(':nth('+nr+')').addClass('selected');
                });

            /*    pauseOnHover */
            if (opts.auto.pauseOnHover && opts.auto.play) {
                $cfs.hover(
                    function() { $cfs.trigger('pause'); },
                    function() { $cfs.trigger('play', direction); }
                );
            }

            /*    via prev-button */
            if (opts.prev.button) {
                opts.prev.button.click(function() {
                    $cfs.trigger('prev');
                    return false;
                });
                if (opts.prev.pauseOnHover && opts.auto.play) {
                    opts.prev.button.hover(
                        function() { $cfs.trigger('pause'); },
                        function() { $cfs.trigger('play', direction); }
                    );
                }
            }

            /* via next-button */
            if (opts.next.button) {
                opts.next.button.click(function() {
                    $cfs.trigger('next');
                    return false;
                });
                if (opts.next.pauseOnHover && opts.auto.play) {
                    opts.next.button.hover(
                        function() { $cfs.trigger('pause'); },
                        function() { $cfs.trigger('play', direction); }
                    );
                }
            }

            /*    via pagination */
            if (opts.pagination.container) {
                $cfs.trigger('updatePageStatus', true);
                if (opts.pagination.pauseOnHover && opts.auto.play) {
                    opts.pagination.container.hover(
                        function() { $cfs.trigger('pause'); },
                        function() { $cfs.trigger('play', direction); }
                    );
                }
            }

            /*     via keyboard */
            if (opts.next.key || opts.prev.key) {
                $(document).keyup(function(e) {
                    var k = e.keyCode;
                    if (k == opts.next.key) {
                        $cfs.trigger('next');
                    }
                    if (k == opts.prev.key) {
                        $cfs.trigger('prev');
                    }
                });
            }
            if (opts.pagination.keys) {
                $(document).keyup(function(e) {
                    var k = e.keyCode;
                    if (k >= 49 && k < 58) {
                        k = (k - 49) * opts.items.visible;
                        if (k <= totalItems) {
                            $cfs.trigger('scrollTo', [k, 0, opts.pagination]);
                        }
                    }
                });
            }

            /*via auto-play*/
            if (opts.auto.play) {
                $cfs.trigger('play', [direction, opts.auto.delay]);
                if ($.fn.nap && opts.auto.nap) {
                    $cfs.nap('pause', 'play');
                }
            }
            return this;
        };    /*end-bind_events*/

        this.destroy = function() {
            $cfs.css({
                width    : 'auto',
                height    : 'auto',
                position: 'static'
            });
            $cfs.unbind('pause')
                .unbind('play')
                .unbind('prev')
                .unbind('next')
                .unbind('scrollTo')
                .unbind('slideTo')
                .unbind('insertItem')
                .unbind('removeItem')
                .unbind('updatePageStatus');

            $wrp.replaceWith($cfs);
            return this;
        };    /*    end-destroy*/

        this.configuration = function(a, b) {
            if (typeof(a) == 'undefined') {
                return opts;
            }
            var c = a.split('.'),
                d = opts,
                f = '';
            for (var e = 0; e < c.length; e++) {
                f = c[e];
                if (e < c.length-1) {
                    d = d[f];
                }
            }
            if (typeof(b) == 'undefined') {
                return d[f];
            } else {
                d[f] = b;

                this.init();
                this.build();
                return this;
            }
        };    /*    end-configuration */

        var $ths            = this,
            $cfs            = $(this),
            $wrp            = $cfs.wrap('<div class="caroufredsel_wrapper" />').parent(),
            opts             = $.extend(true, {}, $.fn.carouFredSel.defaults, o),
            $itm             = getItems($cfs),
            totalItems        = $itm.length,
            firstItem        = 0,
            autoInterval    = null,
            direction        = 'next';

        this.init();
        this.build();
        this.bind_events();
        return this;
    };    /* end carouFredSel */


    /* public */
    $.fn.carouFredSel.defaults = {
        direction    : 'left',
        items         : {
            visible        : 5
        },
        scroll         : {
            easing        : 'swing',
            pauseOnHover: false
        }
    };
    $.fn.carouFredSel.pageAnchorBuilder = function(nr) {
        return '<a href="#"><span>'+nr+'</span></a>';
    };

    /*    private */
    function getKeyCode(string) {
        if (string == 'right') {
            return 39;
        }
        if (string == 'left') {
            return 37;
        }
        if (string == 'up') {
            return 38;
        }
        if (string == 'down') {
            return 40;
        }
        return -1;
    };
    function getNaviObject(obj, pagi, auto) {
        if (typeof(pagi) !== 'boolean') {
            pagi = false;
        }
        if (typeof(auto) !== 'boolean') {
            auto = false;
        }

        if (typeof(obj) == 'undefined') {
            obj  = {};
        }
        if (typeof(obj) == 'string') {
            var temp = getKeyCode(obj);
            if (temp == -1) {
                obj = $(obj);
            } else {
                obj = temp;
            }
        }

        if (pagi) {
            if (typeof(obj.jquery) !== 'undefined')    obj = { container: obj };
            if (typeof(obj) == 'boolean')            obj = { keys: obj };
            if (typeof(obj.container) == 'string')    obj.container = $(obj.container);

        } else if (auto) {
            if (typeof(obj) == 'boolean')            obj = { play: obj };
            if (typeof(obj) == 'number')            obj = { pauseDuration: obj };

        } else {
            if (typeof(obj.jquery) !== 'undefined')    obj = { button: obj };
            if (typeof(obj) == 'number')            obj = { key: obj };
            if (typeof(obj.button) == 'string')        obj.button = $(obj.button);
            if (typeof(obj.key) == 'string')        obj.key = getKeyCode(obj.key);
        }
        return obj;
    };
    function getItems($c) {
        return $('> *', $c);
    }
    function getCurrentItems($c, o, n) {
        var oi = getItems($c).filter(':lt('+o.items.visible+')'),
            ni = getItems($c).filter(':lt('+(o.items.visible + n)+'):gt('+(n-1)+')');
        return [oi, ni];
    };
    function getSizes(o, $i, wrap) {
        if (typeof(wrap) !== 'boolean') wrap = false;
        var SZ = (o.direction == 'right' || o.direction == 'left')
            ? ['width', 'outerWidth', 'height', 'outerHeight', 'left']
            : ['height', 'outerHeight', 'width', 'outerWidth', 'top'];

        var s1 = 0,
            s2 = 0;

             if (wrap && typeof(o[SZ[0]])         == 'number')     s1 = o[SZ[0]];
        else if (         typeof(o.items[SZ[0]]) == 'number')     s1 = o.items[SZ[0]] * $i.length;
        else {
            $i.each(function() {
                s1 += $(this)[SZ[1]](true);
            });
        }

        if (wrap && typeof(o[SZ[2]])         == 'number') {
            s2 = o[SZ[2]];
        } else if ( typeof(o.items[SZ[2]]) == 'number') {
            s2 = o.items[SZ[2]];
        } else {
            $i.each(function() {
                var m = $(this)[SZ[3]](true);
                if (s2 < m) s2 = m;
            });
        }
        return [SZ[0], s1, SZ[2], s2, SZ[4]];
    };
    function setSizes($w, $c, $i, o) {
        var w = getSizes(o, $i.filter(':lt('+o.items.visible+')'), true),
            i = getSizes(o, $i);
        $w.css(w[0], w[1]).css(w[2], w[3]);
        $c.css(i[0], i[1] * 2).css(i[2], i[3]);
    };
    function log(msg) {
        msg = 'carouFredSel: '+msg;
        if (window.console && window.console.log) window.console.log(msg);
        else try { console.log(msg); } catch(err) {}
    };
})(jQuery);
