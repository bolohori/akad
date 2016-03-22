(function(e, c, a, g) {
	var d = "Srm",
		f = {
			breakPoint: parseInt(d.breakpoint),
			touchEvents: true,
			mouseEvents: true,
			moveThreshold: 10,
			intent_delay: 300,
			intent_interval: 150,
			intent_threshold: 300
		};

	function b(i, h) {
		var j = this;
		this.element = i;
		this.$Srm = e(this.element);
		this.$navbar = e("nav.Srm-navbar");
		this.settings = e.extend({}, f, h);
		this.touchenabled = ("ontouchstart" in c || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0);
		if (this.touchenabled) {
			this.$Srm.addClass("Srm-touch")
		} else {
			this.$Srm.addClass("Srm-notouch")
		}
		if (c.navigator.pointerEnabled) {
			this.touchStart = "pointerdown";
			this.touchEnd = "pointerup";
			this.touchMove = "pointermove"
		} else {
			if (c.navigator.msPointerEnabled) {
				this.touchStart = "MSPointerDown";
				this.touchEnd = "MSPointerUp";
				this.touchMove = "MSPointerMove"
			} else {
				this.touchStart = "touchstart";
				this.touchEnd = "touchend";
				this.touchMove = "touchmove"
			}
		}
		this.init()
	}
	b.prototype = {
		init: function() {
			this.$Srm.removeClass("Srm-nojs");
			this.SrmResolveConflics();
			this.SrmDebounced();
			this.SrmInitClasses();
			this.SrmInitOffCanvasCollapsed();
			this.SrmInitFixOffCanvas();
			this.SrmInitStickyOnScroll();
			this.SrmInitContainerWidth();
			this.SrmInitDropdownTouchEvents();
			this.SrmInitDropdownMouseEvents();
			this.SrmInitDropdownCloseAll();
			this.SrmInitDropdownRetractor();
			this.SrmInitTabs();
			this.SrmInitBackgrounds();
			this.SrmInitFirstLevelActive();
			this.SrmInitCart();
			this.SrmInitLogIn();
			this.SrmInitScrollBar();
			this.SrmInitSlideBar()
		},
		SrmResolveConflics: function() {
			this.$Srm.find(".Srm-item, .Srm-dropdown-toggle, .Srm-dropdown-menu, .Srm-dropdown-submenu").add(this.$Srm).removeAttr("style").unbind().off()
		},
		SrmInitDropdownTouchEvents: function(h) {
			if (!this.settings.touchEvents) {
				return
			}
			h = h || this;
			this.$Srm.on(this.touchStart, ".Srm-dropdown > .Srm-dropdown-toggle", function(i) {
				h.handleTouchEvents(i, this, h)
			});
			this.$Srm.on("click", ".Srm-dropdown > .Srm-dropdown-toggle", function(i) {
				h.handleClicks(i, this)
			})
		},
		SrmInitDropdownMouseEvents: function(h) {
			if (!this.settings.mouseEvents) {
				return
			}
			h = h || this;
			if (this.$Srm.hasClass("Srm-trigger-hoverintent") && typeof e.fn.hoverIntent !== "undefined") {
				this.$Srm.find(".Srm-item.Srm-dropdown").hoverIntent({
					over: function() {
						h.triggerSubmenu(e(this), h)
					},
					out: function() {
						h.closeSubmenu(e(this))
					},
					sensitivity: h.settings.intent_interval,
					timeout: h.settings.intent_delay,
					interval: h.settings.intent_threshold
				})
			} else {
				this.$Srm.on("click", ".Srm-item > .Srm-dropdown-toggle", function(i) {
					h.handleMouseClick(i, this, h)
				})
			}
			this.$Srm.on("click", ".Srm-item > .Srm-dropdown-toggle", function(i) {
				h.handleLink(i, this)
			})
		},
		SrmInitDropdownRetractor: function() {
			var h = this;
			if (!this.$Srm.hasClass("Srm-is-responsive") && (this.$Srm.hasClass("Srm-is-horizontal") || this.$Srm.hasClass("Srm-trigger-hoverintent"))) {
				this.$Srm.find(".Srm-item > .Srm-dropdown-toggle > .Srm-caret.Srm-close").removeClass("Srm-close");
				this.$Srm.off("shown.Srm.dropdown.retractor");
				this.$Srm.off("hidden.Srm.dropdown.retractor");
				return
			}
			this.$Srm.on("click", ".Srm-item > .Srm-dropdown-toggle > .Srm-caret.Srm-close", function(i) {
				h.handleDropdownCloseEnd(i, this, h)
			});
			if (this.settings.touchEvents) {
				this.$Srm.on(this.touchStart, ".Srm-item > .Srm-dropdown-toggle > .Srm-caret.Srm-close", function(i) {
					h.handleDropdownCloseStart(i, this, h)
				})
			}
			this.$Srm.find(".Srm-item.open > .Srm-dropdown-toggle > .Srm-caret").addClass("Srm-close");
			this.$Srm.on("shown.Srm.dropdown.retractor", ".Srm-item", function() {
				e(this).find("> .Srm-dropdown-toggle > .Srm-caret").addClass("Srm-close")
			});
			this.$Srm.on("hidden.Srm.dropdown.retractor", ".Srm-item", function() {
				e(this).find("> .Srm-dropdown-toggle > .Srm-caret").removeClass("Srm-close")
			})
		},
		SrmInitDropdownCloseAll: function() {
			var h = this;
			if (this.touchenabled) {
				e(a).on(this.touchEnd, function(i) {
					h.handleDropdownCloseAll(i, h)
				})
			}
			if (!this.touchenabled && !this.$Srm.hasClass("Srm-is-vertical")) {
				e(a).on("click.hidden.Srm.dropdown.all", function(i) {
					h.handleDropdownCloseAll(i, h)
				})
			}
		},
		handleClicks: function(j, i) {
			var h = e(i);
			if (h.data("Srm-killClick")) {
				j.preventDefault()
			}
		},
		handleTouchEvents: function(k, j, i) {
			k.stopPropagation();
			var h = e(j);
			h.parent().off("mouseleave.hoverIntent");
			h.on(i.touchEnd, function(m) {
				i.handleTouchTap(m, this, i)
			});
			h.on(i.touchMove, function(m) {
				i.preventTapOnScroll(m, this, i)
			});
			if (k.originalEvent.touches) {
				h.data("Srm-startX", k.originalEvent.touches[0].clientX);
				h.data("Srm-startY", k.originalEvent.touches[0].clientY)
			} else {
				if (k.originalEvent.clientY) {
					var l = h.offset();
					h.data("Srm-startX", k.originalEvent.clientX);
					h.data("Srm-startY", k.originalEvent.clientY)
				}
			}
		},
		preventTapOnScroll: function(k, j, i) {
			var h = e(j);
			if (k.originalEvent.touches) {
				if (Math.abs(k.originalEvent.touches[0].clientX - h.data("Srm-startX")) > i.settings.moveThreshold || Math.abs(k.originalEvent.touches[0].clientY - h.data("Srm-startY")) > i.settings.moveThreshold) {
					i.resetHandlers(h)
				}
			} else {
				if (k.originalEvent.clientY) {
					var l = h.data(l);
					if (Math.abs(k.originalEvent.clientX - h.data("Srm-startX")) > i.settings.moveThreshold || Math.abs(k.originalEvent.clientY - h.data("Srm-startY")) > i.settings.moveThreshold) {
						i.resetHandlers(h)
					}
				}
			}
		},
		handleTouchTap: function(k, j, i) {
			k.preventDefault();
			k.stopPropagation();
			var h = e(j),
				l = h.parent();
			h.data("Srm-killClick", true);
			h.data("Srm-killHover", true);
			setTimeout(function() {
				h.data("Srm-killClick", false).data("Srm-killHover", false)
			}, 1000);
			i.closeSubmenu(l.siblings(".open"));
			if (l.hasClass("Srm-dropdown")) {
				if (l.hasClass("open")) {
					if (!l.hasClass("Srm-item-type-tab")) {
						i.closeSubmenu(l)
					}
					i.handleLink(k, j, true)
				} else {
					i.openSubmenu(l)
				}
			} else {
				i.handleLink(k, j, true)
			}
			i.resetHandlers(h)
		},
		handleLink: function(l, k, h) {
			h = h || false;
			var j = e(k),
				i = j.attr("href");
			if (!j.is("a")) {
				return
			}
			if (!i) {
				l.preventDefault();
				return
			}
			if (!h || !l.isDefaultPrevented()) {
				return
			}
			if (j.attr("target") === "_blank") {
				c.open(i, "_blank")
			} else {
				c.location = i
			}
		},
		handleMouseClick: function(k, j, i) {
			var h = e(j),
				l = h.parent(".Srm-item");
			if (h.data("Srm-killClick") || !l.size()) {
				return
			}
			l.off("mousemove.hoverIntent");
			l.off("mouseleave.hoverIntent");
			if (l.hasClass("open")) {
				if (h.is("a")) {
					i.handleLink(k, j)
				}
				if (!l.hasClass("Srm-item-type-tab")) {
					i.closeSubmenu(l)
				}
			} else {
				if (l.hasClass("Srm-dropdown")) {
					k.preventDefault();
					i.closeSubmenu(l.siblings(".open"));
					i.openSubmenu(l, "click")
				}
			}
		},
		handleDropdownCloseStart: function(i, j, h) {
			i.preventDefault();
			i.stopPropagation();
			e(j).on(h.touchEnd, function(k) {
				h.handleDropdownCloseEnd(k, this, h)
			})
		},
		handleDropdownCloseEnd: function(j, k, i) {
			j.preventDefault();
			j.stopPropagation();
			var h = e(k).closest(".Srm-dropdown.open");
			i.closeSubmenu(h);
			e(k).off(i.touchEnd);
			return false
		},
		handleDropdownCloseAll: function(i, h) {
			if (e(i.target).closest("#Srm").length) {
				return
			}
			h.closeAllSubmenus()
		},
		resetHandlers: function(h) {
			h.off(this.touchEnd);
			h.off(this.touchMove);
			var i = h.parent();
			i.off("mousemove.hoverIntent");
			i.off("mouseleave.hoverIntent");
			i.removeProp("hoverIntent_t");
			i.removeProp("hoverIntent_s")
		},
		triggerSubmenu: function(i, h) {
			h.closeSubmenu(i.siblings(".open"));
			h.openSubmenu(i)
		},
		openSubmenu: function(h) {
			if (h.hasClass("open")) {
				return
			}
			h.addClass("open");
			h.trigger("shown.Srm.dropdown")
		},
		closeSubmenu: function(h) {
			if (!h.hasClass("open")) {
				return
			}
			h.removeClass("open");
			h.trigger("hidden.Srm.dropdown")
		},
		closeAllSubmenus: function() {
			var h = this.$Srm.find(".Srm-item-level-0.open");
			if (h.length) {
				this.closeSubmenu(h)
			}
			return
		},
		SrmInitBackgrounds: function() {
			var h = this.$Srm.find(".Srm-dropdown.Srm-has-background > .Srm-dropdown-menu"),
				i = h.data("Srm-src");
			e("<img />").attr("src", i);
			h.css({
				"background-image": "url(" + i + ")"
			})
		},
		SrmInitTabs: function() {
			var h = this;
			h.$tabs = h.$Srm.find(".Srm-item-type-Srm-tabs.Srm-dropdown.Srm-item-level-0");
			h.$tabs_block = h.$tabs.find("> .Srm-dropdown-menu");
			if (!this.$Srm.hasClass("Srm-is-horizontal")) {
				h.$tabs_block.css("min-height", "");
				return
			}
			h.$tabs.each(function() {
				var i = e(this).hasClass("open"),
					j = e(this).find(".Srm-item-type-tab.open");
				if (i) {
					h.sizeTabs(j)
				}
			});
			h.$tabs.on("shown.Srm.dropdown.sizetabs", function() {
				h.sizeTabs(e(this).find(".Srm-item-type-tab.open"))
			})
		},
		sizeTabs: function(i) {
			var h = this;
			h.$tabs.each(function() {
				e(this).on("shown.Srm.dropdown", ".Srm-item-type-tab", function() {
					e(this).find("> .Srm-dropdown-menu").css({
						visibility: "hidden",
						display: "block"
					});
					h.$tabs_block.css({
						"min-height": e(this).find("> .Srm-dropdown-menu").outerHeight() + "px"
					});
					e(this).find("> .Srm-dropdown-menu").removeAttr("style")
				})
			});
			if (i.length) {
				return
			}
			h.openSubmenu(h.$tabs.find(".Srm-item-type-tab").first())
		},
		SrmInitFirstLevelActive: function() {
			this.$Srm.find(".Srm-current-menu-item:not(.Srm-item-type-tab)").addClass("active").first().parents(".Srm-item:not(.Srm-item-type-tab)").addClass("active")
		},
		SrmInitStickyOnScroll: function() {
			var h = this;
			h.$sticky = this.$navbar.filter('[data-sticky="1"]').first();
			if (h.$sticky.hasClass("Srm-is-vertical") || !h.$sticky.length || typeof e.fn.scrollTop === "undefined") {
				return
			}
			e(c).scroll(function() {
				h.handleStickyOnScroll()
			})
		},
		handleStickyOnScroll: function() {
			var l = this;
			var j = l.$sticky.height();
			l.$sticky.on("hidden.bs.collapse shown.bs.collapse", function() {
				j = e(this).height()
			});
			var i = Math.abs(l.$sticky.data("stickyoffset")),
				k = i > j ? i : j + 10,
				m = k,
				h = e(c).scrollTop();
			if (m == 0 && !l.$sticky.hasClass("Srm-navbar-fixed-top")) {
				l.$sticky.toggleClass("Srm-navbar-fixed-top").trigger("sticky.Srm.navbar");
				return
			}
			if (h >= m && !l.$sticky.hasClass("Srm-navbar-fixed-top")) {
				l.$sticky.find(".Srm-navbar-collapse.collapse.in").collapse("hide");
				l.$sticky.toggleClass("Srm-navbar-fixed-top");
				l.$sticky.trigger("sticking.Srm.navbar");
				setTimeout(function() {
					l.$sticky.trigger("sticky.Srm.navbar")
				}, 200)
			} else {
				if (h < m && l.$sticky.hasClass("Srm-navbar-fixed-top")) {
					l.$sticky.toggleClass("Srm-navbar-fixed-top");
					l.$sticky.trigger("unsticking.Srm.navbar");
					setTimeout(function() {
						l.$sticky.trigger("unsticky.Srm.navbar")
					}, 200)
				}
			}
		},
		SrmInitContainerWidth: function(h) {
			h = h || this;
			h.handleContainerWidth(this.$navbar);
			this.$navbar.on("sticking.Srm.navbar unsticking.Srm.navbar", function() {
				h.handleContainerWidth(e(this))
			})
		},
		handleContainerWidth: function(i) {
			var j = e(i),
				k = j.find(".container-auto"),
				h = j.parent().innerWidth();
			if (!k.length) {
				return
			}
			if (j.hasClass("Srm-navbar-fixed-top")) {
				k.css({
					width: h + "px"
				})
			} else {
				k.removeAttr("style")
			}
		},
		SrmInitCart: function(j) {
			j = j || this;
			var i = j.$Srm.find("li.Srm-item-type-Srm-cart"),
				h = i.find("> a").data("cart-url"),
				k = i.find("> a").data("cart-qty");
			if (!i.length) {
				return
			}
			if (k === 0) {
				i.removeClass("Srm-dropdown")
			}
			e("body").bind("added_to_cart", function() {
				j.handleWooCart(j, i, h)
			});
			e("body").bind("edd_quantity_updated", function() {
				j.handleEddCart(j, i, h)
			})
		},
		handleWooCart: function(j, i, h) {
			j = j || this;
			i.each(function() {
				var o = i.find(".widget_shopping_cart");
				if (!o.length) {
					return
				}
				var m = o.find(".total .amount").html(),
					k = o.find(".quantity"),
					n = 0,
					l = /\d+/g;
				k.each(function(p, r) {
					var s = e(r).html().match(l);
					var q = parseInt(s[0]);
					n = n + q
				});
				j.updateCart(e(this), m, n, h)
			})
		},
		handleEddCart: function(j, i, h) {
			j = j || this;
			i.each(function() {
				var l = i.find(".widget_edd_cart_widget");
				if (!l.length) {
					return
				}
				var k = l.find(".edd_subtotal .subtotal").html(),
					m = l.find(".edd-cart-quantity").html();
				j.updateCart(e(this), k, m, h)
			})
		},
		updateCart: function(m, l, n, i) {
			var k = e(m);
			var h = k.find(".cart_total"),
				j = k.find(".cart_qty");
			j.addClass("animate");
			h.html(l);
			j.html(n);
			if (n > 0) {
				k.addClass("Srm-dropdown")
			}
			if (i) {
				k.find("> a").attr("href", i)
			}
			setTimeout(function() {
				j.removeClass("animate")
			}, 1500)
		},
		SrmInitFixOffCanvas: function() {
			var m = this.$Srm.closest(".navbar-offcanvas"),
				j = this.$Srm.closest('.navmenu[class*="offcanvas-"]'),
				l = e(c).width() > this.settings.breakPoint ? false : true,
				i = e(c).width() * 0.68,
				h = e("body").data("offcanvas-style");
			if (m.length) {
				if (!l) {
					m.removeAttr("style").removeClass("in").removeClass("canvas-slid");
					e("body").removeAttr("style");
					if (h) {
						e("body").attr("style", e("body").data("offcanvas-style")).removeData("offcanvas-style")
					}
					return
				}
				var k = m.outerWidth();
				if (k > i) {
					m.css({
						width: i + "px"
					})
				}
				return
			}
			if (j.length) {
				if (!l) {
					j.removeAttr("style");
					return
				}
				var k = j.outerWidth();
				if (k > i) {
					j.css({
						width: i + "px"
					})
				}
				return
			}
		},
		SrmInitOffCanvasCollapsed: function() {
			var i = this.$Srm.closest('.navmenu[class*="offcanvas-"]'),
				h = i.outerWidth();
			if (!i.length || i.hasClass("inherit")) {
				return
			}
			i.addClass("in-temp");
			i.on("hidden.bs.offcanvas", function() {
				e("body").removeClass("Srm-offcanvas-left Srm-offcanvas-right")
			});
			if (i.length && !i.hasClass("in") && i.is(":visible") && i.hasClass("navmenu-fixed-right")) {
				e("body").addClass("Srm-offcanvas");
				e("body").css({
					paddingRight: h + "px"
				});
				return
			} else {
				if (i.length && !i.hasClass("in") && i.is(":visible") && i.hasClass("navmenu-fixed-left")) {
					e("body").addClass("Srm-offcanvas");
					e("body").css({
						paddingLeft: h + "px"
					});
					return
				} else {
					if (e("body").hasClass("Srm-offcanvas")) {
						e("body").removeClass("Srm-offcanvas");
						e("body").css({
							paddingLeft: ""
						});
						e("body").css({
							paddingRight: ""
						});
						return
					}
				}
			}
		},
		SrmInitLogIn: function(h) {
			h = h || this;
			h.$login = h.$Srm.find(".Srm-item-type-Srm-login.Srm-item-level-0");
			h.$login.each(function() {
				var i = e(this).find("form.Srm-registration-form"),
					j = i.find("#btn-new-user");
				h.handleRegister(i, j)
			})
		},
		handleRegister: function(j, i) {
			var k = e(i),
				h = e(j);
			k.click(function(m) {
				if (m.preventDefault) {
					m.preventDefault()
				} else {
					m.returnValue = false
				}
				var u = h.find(".indicator").show(),
					o = h.find(".result-message").hide();
				u.show();
				o.hide();
				var s = h.find("#Srm_new_user_nonce").val();
				var v = h.find("#Srm_username").val();
				var p = h.find("#Srm_pass").val();
				var l = h.find("#Srm_email").val();
				var t = h.find("#Srm_name").val();
				var r = h.find("#Srm_nick").val();
				var q = Srm.ajax_url;
				var n = {
					action: "register_user",
					nonce: s,
					user: v,
					pass: p,
					mail: l,
					name: t,
					nick: r
				};
				e.post(q, n, function(w) {
					if (w) {
						u.hide();
						if (w === "1") {
							o.html(Srm.registered);
							o.removeClass("alert-danger").addClass("alert-success");
							o.show()
						} else {
							o.html(w);
							o.addClass("alert-danger");
							o.show()
						}
					}
				})
			})
		},
		SrmInitScrollBar: function(h) {
			h = h || this;
			if (!this.$Srm.hasClass("Srm-is-vertical") || typeof e.fn.perfectScrollbar === "undefined") {
				return
			}
			h.$navmenu = this.$Srm.closest("#Srm");
			if (!h.$navmenu.length) {
				return
			}
			h.$navmenu.perfectScrollbar({
				suppressScrollX: false,
				includePadding: true
			});
			h.$navmenu.on("shown.bs.offcanvas hidden.bs.offcanvas shown.Srm.dropdown hidden.Srm.dropdown", function() {
				h.$navmenu.perfectScrollbar("update")
			})
		},
		SrmInitClasses: function() {
			var i = e("body"),
				j = e(c).width() > this.settings.breakPoint ? false : true,
				k = (i.hasClass("Srm-offcanvas") || i.hasClass("canvas-sliding") || i.hasClass("canvas-slid")),
				h = ((j && this.$Srm.closest(".navbar-offcanvas").length) || this.$Srm.closest(".navmenu-nav").length);
			if (k || h) {
				this.$Srm.addClass("Srm-is-vertical").removeClass("Srm-is-horizontal")
			}
			if (!k && !h && !j) {
				this.$Srm.addClass("Srm-is-horizontal").removeClass("Srm-is-vertical")
			}
			if (!j) {
				this.$Srm.removeClass("Srm-is-responsive")
			}
			if (j) {
				this.$Srm.addClass("Srm-is-responsive").removeClass("Srm-is-horizontal").removeClass("Srm-is-vertical")
			}
		},
		SrmInitSlideBar: function(h) {
			h = h || this;
			if (this.$Srm.hasClass("Srm-touch") || this.$Srm.hasClass("Srm-is-vertical") || !this.$Srm.hasClass("Srm-hover-slidebar")) {
				return
			}
			e(c).load(function() {
				h.$Srm.append('<span class="Srm-hover-slidebar hidden"><span class="bar"></span></span>');
				h.handleSlideBar(h.$Srm)
			})
		},
		handleSlideBar: function(o, n) {
			n = n || this;
			var l = e(o),
				m = l.find("span.Srm-hover-slidebar"),
				q = l.find("> li.Srm-item.Srm-item-level-0.active"),
				q = !q.length ? l.find("> li.Srm-item.Srm-item-level-0:not(.Srm-item-type-Srm-icon):not(.Srm-item-type-Srm-search):not(.Srm-item-type-Srm-cart):not(.Srm-item-type-Srm-login)").first() : q,
				i = q.find("> a"),
				h = "auto",
				p = parseInt(i.css("margin-left")),
				k = parseInt(q.position().left),
				j = parseInt(i.outerWidth());
			if (l.hasClass("sl-middle") && h === "auto") {
				h = Math.round(parseInt(q.find("> a").css("padding-bottom")) * 0.75 + parseInt(q.find("> a").css("margin-bottom"))) + "px"
			}
			m.css({
				width: j + "px",
				left: k + p + "px",
				bottom: h
			}).removeClass("hidden");
			m.data("slidebar-style", m.attr("style"));
			this.$navbar.on("sticky.Srm.navbar unsticky.Srm.navbar", function() {
				m.hide();
				var u = e(this).find(".Srm-navbar-nav"),
					s = u.find("> li.Srm-item.Srm-item-level-0.active"),
					s = !s.length ? u.find("> li.Srm-item.Srm-item-level-0:not(.Srm-item-type-Srm-icon):not(.Srm-item-type-Srm-search):not(.Srm-item-type-Srm-cart):not(.Srm-item-type-Srm-login)").first() : s,
					v = s.find("> a"),
					t = Math.round(parseInt(v.css("padding-bottom")) * 0.75 + parseInt(v.css("margin-bottom"))) + "px",
					r = parseInt(s.position().left);
				m.css({
					left: r + p + "px",
					bottom: t
				});
				m.data("slidebar-style", m.attr("style")).show()
			});
			l.on("mouseleave", function() {
				m.attr("style", m.data("slidebar-style")).show()
			});
			l.find("> li.Srm-item.Srm-item-level-0:not(.Srm-item-type-Srm-icon):not(.Srm-item-type-Srm-search):not(.Srm-item-type-Srm-cart):not(.Srm-item-type-Srm-login)").on("hover", function() {
				var s = parseInt(e(this).find("> a").css("margin-left")),
					r = parseInt(e(this).position().left),
					t = parseInt(e(this).find("> a").outerWidth());
				m.css({
					width: t + "px",
					left: r + s + "px"
				}).show()
			})
		},
		SrmDebounced: function(h) {
			h = h || this;
			e(c).on("debouncedresize", function(i) {
				h.SrmInitClasses();
				h.SrmInitStickyOnScroll();
				h.SrmInitOffCanvasCollapsed();
				h.SrmInitFixOffCanvas();
				h.SrmInitDropdownRetractor();
				h.SrmInitDropdownCloseAll();
				h.SrmInitContainerWidth();
				h.SrmInitTabs()
			})
		}
	};
	e.fn[d] = function(i) {
		var h = arguments;
		if (i === g || typeof i === "object") {
			return this.each(function() {
				if (!e.data(this, "plugin_" + d)) {
					e.data(this, "plugin_" + d, new b(this, i))
				}
			})
		} else {
			if (typeof i === "string" && i[0] !== "_" && i !== "init") {
				var j;
				this.each(function() {
					var k = e.data(this, "plugin_" + d);
					if (k instanceof b && typeof k[i] === "function") {
						j = k[i].apply(k, Array.prototype.slice.call(h, 1))
					}
					if (i === "destroy") {
						e.data(this, "plugin_" + d, null)
					}
				});
				return j !== g ? j : this
			}
		}
	}
})(jQuery, window, document);
(function(c) {
	var a = false;
	jQuery(function() {
		b()
	});
	c(window).load(function() {
		b()
	});

	function b() {
		if (a) {
			return
		}
		a = true;
		if (window.location.hash.substring(1, 2) == ".") {
			var d = c(window.location.hash.substring(1));
			if (d.size()) {
				window.scrollTo(0, d.offset().top)
			}
		}
		c(".navmenu-nav, .Srm-navbar-nav").Srm()
	}
})(jQuery);
(function(d) {
	var b = d.event,
		a, c;
	a = b.special.debouncedresize = {
		setup: function() {
			d(this).on("resize", a.handler)
		},
		teardown: function() {
			d(this).off("resize", a.handler)
		},
		handler: function(i, e) {
			var h = this,
				g = arguments,
				f = function() {
					i.type = "debouncedresize";
					b.dispatch.apply(h, g)
				};
			if (c) {
				clearTimeout(c)
			}
			e ? f() : c = setTimeout(f, a.threshold)
		},
		threshold: 150
	}
})(jQuery);