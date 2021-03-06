

Fox.define('views/site/navbar', 'view', function (Dep) {

    return Dep.extend({

        template: 'site/navbar',

        currentTab: null,

        data: function () {
            return {
                tabListDefs: this.tabListDefs,
                title: this.options.title,
                menu: this.getMenuDefs(),
                quickCreateList: this.quickCreateList,
                enableQuickCreate: this.quickCreateList.length > 0,
                userName: this.getUser().get('name'),
                userId: this.getUser().id,
                logoSrc: this.getLogoSrc()
            };
        },

        events: {
            'click .navbar-collapse.in a.nav-link': function (e) {
                var $a = $(e.currentTarget);
                var href = $a.attr('href');
                if (href && href != '#') {
                    this.$el.find('.navbar-collapse.in').collapse('hide');
                }
            },
            'click a[data-action="quick-create"]': function (e) {
                e.preventDefault();
                var scope = $(e.currentTarget).data('name');
                this.notify('Loading...');
                this.createView('quickCreate', 'views/modals/edit', {scope: scope}, function (view) {
                    view.once('after:render', function () {
                        this.notify(false);
                    });
                    view.render();
                });
            },
            'click .navbar-header a.minimizer': function () {
                var $body = $('body');
                if ($body.hasClass('minimized')) {
                    $body.removeClass('minimized');
                    this.getStorage().clear('state', 'layoutMinimized');
                } else {
                    $body.addClass('minimized');
                    this.getStorage().set('state', 'layoutMinimized', true);
                }
            }
        },

        getLogoSrc: function () {
            var companyLogoId = this.getConfig().get('companyLogoId');
            if (!companyLogoId) {
                return this.getBasePath() + (this.getThemeManager().getParam('logo') || 'client/img/logo.png');
            }
            return this.getBasePath() + '?entryPoint=LogoImage&t=' + companyLogoId;
        },

        getTabList: function () {
            var tabList = this.getPreferences().get('useCustomTabList') ? this.getPreferences().get('tabList') : this.getConfig().get('tabList');
            return tabList || [];
        },

        getQuickCreateList: function () {
            return this.getConfig().get('quickCreateList') || [];
        },

        setup: function () {
            this.getRouter().on('routed', function (e) {
                if (e.controller) {
                    this.selectTab(e.controller);
                } else {
                    this.selectTab(false);
                }
            }.bind(this));

            var tabList = this.getTabList();

            var scopes = this.getMetadata().get('scopes') || {};

            this.tabList = tabList.filter(function (scope) {
                if ((scopes[scope] || {}).disabled) return;
                if ((scopes[scope] || {}).acl) {
                    return this.getAcl().check(scope);
                }
                return true;
            }, this);

            this.quickCreateList = this.getQuickCreateList().filter(function (scope) {
                if ((scopes[scope] || {}).disabled) return;
                if ((scopes[scope] || {}).acl) {
                    return this.getAcl().check(scope, 'create');
                }
                return true;
            }, this);

            //this.createView('notificationsBadge', 'views/notification/badge', {
            //    el: this.options.el + ' .notifications-badge-container'
            //});


            this.setupGlobalSearch();


            this.setupTabListDefs();

            this.once('remove', function () {
                $(window).off('resize.navbar');
                $(window).off('scroll.navbar');
            });
        },

        setupGlobalSearch: function () {
            this.globalSearchAvailable = false;
            (this.getConfig().get('globalSearchEntityList') || []).forEach(function (scope) {
                if (this.globalSearchAvailable) return;
                if (this.getAcl().checkScope(scope)) {
                    this.globalSearchAvailable = true;
                }
            }, this);

            if (this.globalSearchAvailable) {
                this.createView('globalSearch', 'views/global-search/global-search', {
                    el: this.options.el + ' .global-search-container'
                });
            }
        },

        adjust: function () {
            var $window = $(window);

            var navbarIsVertical = this.getThemeManager().getParam('navbarIsVertical');
            var navbarStaticItemsHeight = this.getThemeManager().getParam('navbarStaticItemsHeight') || 0;

            var smallScreenWidth = this.getThemeManager().getParam('screenWidthXs');

            if (!navbarIsVertical) {
                var $tabs = this.$el.find('ul.tabs');
                var $moreDropdown = $tabs.find('li.more');
                var $more = $tabs.find('li.more > ul');

                $window.on('resize.navbar', function() {
                    updateWidth();
                });

                var hideOneTab = function () {
                    var count = $tabs.children().size();
                    var $one = $tabs.children().eq(count - 2);
                    $one.prependTo($more);
                };
                var unhideOneTab = function () {
                    var $one = $more.children().eq(0);
                    if ($one.size()) {
                        $one.insertBefore($moreDropdown);
                    }
                };

                var tabCount = this.tabList.length;
                var $navbar = $('#navbar .navbar');
                var navbarNeededHeight = 45;

                $moreDd = $('#nav-more-tabs-dropdown');


                var updateWidth = function () {
                    var windowWidth = $(window.document).width();
                    var windowWidth = window.innerWidth;
                    var moreWidth = $moreDd.width();

                    $more.children('li').each(function (i, li) {
                        unhideOneTab();
                    });

                    $more.parent().addClass('hidden');

                    if (windowWidth < smallScreenWidth) {
                        return;
                    }

                    var headerWidth = this.$el.width();

                    var maxWidth = headerWidth - 546 - moreWidth;
                    var width = $tabs.width();

                    var i = 0;
                    while (width > maxWidth) {
                        hideOneTab();
                        width = $tabs.width();
                        i++;
                        if (i >= tabCount) {
                            setTimeout(function () {
                                updateWidth();
                            }, 100);
                            break;
                        }
                    }

                    if ($more.children().size() > 0) {
                        $moreDropdown.removeClass('hidden');
                    }
                }.bind(this);

                var processUpdateWidth = function () {
                    if ($navbar.height() > navbarNeededHeight) {
                        updateWidth();
                        setTimeout(function () {
                            processUpdateWidth();
                        }, 200);
                    } else {
                        setTimeout(function () {
                            processUpdateWidth();
                        }, 1000);
                    }
                };

                if ($navbar.height() <= navbarNeededHeight) {
                    $more.parent().addClass('hidden');
                }

                processUpdateWidth();


            } else {
                var $tabs = this.$el.find('ul.tabs');

                var minHeight = $tabs.height() + navbarStaticItemsHeight;
                $('body').css('minHeight', minHeight + 'px');
                $window.on('scroll.navbar', function () {
                    $tabs.scrollTop($window.scrollTop());
                }.bind(this));

                var updateHeight = function () {
                    var windowHeight = window.innerHeight;
                    var windowWidth = window.innerWidth;

                    if (windowWidth < smallScreenWidth) {
                        $tabs.css('height', 'none');
                        return;
                    }

                    $tabs.css('height', (windowHeight - navbarStaticItemsHeight) + 'px');
                }.bind(this);

                $(window).on('resize.navbar', function() {
                    updateHeight();
                });
                updateHeight();
            }
        },

        afterRender: function () {
            this.selectTab(this.getRouter().getLast().controller);

            if (this.getStorage().get('state', 'layoutMinimized')) {
                var $body = $('body');
                $body.addClass('minimized');
            }
            this.$navbar = this.$el.find('> .navbar');

            if (this.getThemeManager().getParam('navbarIsVertical')) {
                var process = function () {
                    if (this.$navbar.height() < $(window).height() / 2) {
                        setTimeout(function () {
                            process();
                        }.bind(this), 50);
                        return;
                    }
                    if (this.getThemeManager().isUserTheme()) {
                        setTimeout(function () {
                            this.adjust();
                        }.bind(this), 10);
                        return;
                    }
                    this.adjust();
                }.bind(this);
                process();
            } else {
                var process = function () {
                    if (this.$el.width() < $(window).width() / 2) {
                        setTimeout(function () {
                            process();
                        }.bind(this), 50);
                        return;
                    }
                    if (this.getThemeManager().isUserTheme()) {
                        setTimeout(function () {
                            this.adjust();
                        }.bind(this), 10);
                        return;
                    }
                    this.adjust();
                }.bind(this);
                process();
            }
        },

        selectTab: function (name) {
            if (this.currentTab != name) {
                this.$el.find('ul.tabs li.active').removeClass('active');
                if (name) {
                    this.$el.find('ul.tabs  li[data-name="' + name + '"]').addClass('active');
                }
                this.currentTab = name;
            }
        },

        setupTabListDefs: function () {
            var tabListDefs = [];
            this.tabList.forEach(function (tab, i) {
                var label = this.getLanguage().translate(tab, 'scopeNamesPlural');
                var o = {
                    link: '#' + tab,
                    label: label,
                    shortLabel: label.substr(0, 2),
                    name: tab
                };
                tabListDefs.push(o);
            }, this);
            this.tabListDefs = tabListDefs;
        },

        getMenuDefs: function () {
            var menuDefs = [
                {
                    link: '#Preferences',
                    label: this.getLanguage().translate('Preferences'),
                },
                {
                    link: '#About',
                    label: this.getLanguage().translate('About'),
                },
                {
                    divider: true,
                },
                {
                    link: '#clearCache',
                    label: this.getLanguage().translate('Clear Local Cache'),
                },
                {
                    link: '#logout',
                    label: this.getLanguage().translate('Log Out'),
                },
            ];

            if (this.getUser().isAdmin()) {
                menuDefs.unshift({
                    link: '#Admin',
                    label: this.getLanguage().translate('Administration'),
                });
            }
            return menuDefs;
        }
    });

});


