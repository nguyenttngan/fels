(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost:8000/',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":null,"action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":null,"action":"App\Http\Controllers\Web\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"words","name":null,"action":"App\Http\Controllers\Web\WordsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"categories","name":null,"action":"App\Http\Controllers\Web\CategoriesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"lessons","name":null,"action":"App\Http\Controllers\Web\LessonsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"lessons\/show\/{lessonId}","name":null,"action":"App\Http\Controllers\Web\LessonsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"lessons\/create\/{categoryId}\/{lessonId?}\/{count?}","name":null,"action":"App\Http\Controllers\Web\LessonsController@create"},{"host":null,"methods":["POST"],"uri":"lessons\/update","name":null,"action":"App\Http\Controllers\Web\LessonsController@update"},{"host":null,"methods":["POST"],"uri":"follows\/{user}","name":"follows","action":"App\Http\Controllers\Web\FollowsController@follow"},{"host":null,"methods":["GET","HEAD"],"uri":"follows\/{user}","name":null,"action":"App\Http\Controllers\Web\FollowsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/home","name":null,"action":"App\Http\Controllers\Admin\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categories","name":"categories.index","action":"App\Http\Controllers\Admin\CategoryController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categories\/create","name":"categories.create","action":"App\Http\Controllers\Admin\CategoryController@create"},{"host":null,"methods":["POST"],"uri":"admin\/categories","name":"categories.store","action":"App\Http\Controllers\Admin\CategoryController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categories\/{category}","name":"categories.show","action":"App\Http\Controllers\Admin\CategoryController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categories\/{category}\/edit","name":"categories.edit","action":"App\Http\Controllers\Admin\CategoryController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/categories\/{category}","name":"categories.update","action":"App\Http\Controllers\Admin\CategoryController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/categories\/{category}","name":"categories.destroy","action":"App\Http\Controllers\Admin\CategoryController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users","name":"users.index","action":"App\Http\Controllers\Admin\UsersController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/create","name":"users.create","action":"App\Http\Controllers\Admin\UsersController@create"},{"host":null,"methods":["POST"],"uri":"admin\/users","name":"users.store","action":"App\Http\Controllers\Admin\UsersController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/{user}","name":"users.show","action":"App\Http\Controllers\Admin\UsersController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/{user}\/edit","name":"users.edit","action":"App\Http\Controllers\Admin\UsersController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/users\/{user}","name":"users.update","action":"App\Http\Controllers\Admin\UsersController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/users\/{user}","name":"users.destroy","action":"App\Http\Controllers\Admin\UsersController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/show\/{user?}","name":null,"action":"App\Http\Controllers\Web\UsersController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"users\/edit","name":null,"action":"App\Http\Controllers\Web\UsersController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"user\/{user}","name":"user.update","action":"App\Http\Controllers\Web\UsersController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"social\/redirect\/{provider}","name":null,"action":"App\Http\Controllers\Auth\SocialAuthController@redirect"},{"host":null,"methods":["GET","HEAD"],"uri":"social\/handle\/{provider}","name":null,"action":"App\Http\Controllers\Auth\SocialAuthController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

