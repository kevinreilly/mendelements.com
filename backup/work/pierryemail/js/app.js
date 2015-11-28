var app = angular.module('pierryEmail', ['ui.router']);

// Routing
app.config(function($stateProvider, $urlRouterProvider) {
    
    $urlRouterProvider.otherwise('/');
    
    $stateProvider
    .state('/', {
        url: '/',
        templateUrl: 'views/home.html',
    })
    .state('clients', {
        url: '/clients',
        templateUrl: 'views/clients.html',
    })
    .state('emails', {
        url: '/emails',
        templateUrl: 'views/emails.html',
    })
    .state('snippets', {
        url: '/snippets',
        templateUrl: 'views/snippets.html',
        controller: 'clientSnippetsCtrl'
    })
    .state('templates', {
        url: '/templates',
        templateUrl: 'views/templates.html',
    })
});

// Main Controller
app.controller('mainCtrl', function($scope, $http){
    $http.get('http://mendelements.com/work/pierryemail/wordpress/wp-json/taxonomies/client/terms', {cache:true}).
    success(function(response){
        $scope.clients = response;
    });
    $http.get('http://mendelements.com/work/pierryemail/wordpress/wp-json/posts?type=snippet', {cache:true}).
    success(function(response){
        $scope.snippets = response;
    });
});

//Navigation Controller
app.controller('navCtrl', function($scope, $location){ 
    $scope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };
});

// Snippets Controller
app.controller('clientSnippetsCtrl', function($scope, $http){
    $scope.getClientSnippets = function(clientSlug){
        var url = 'http://mendelements.com/work/pierryemail/wordpress/wp-json/posts?type=snippet&filter[client]=' + clientSlug;
        $http.get(url, {cache:true}).
        success(function(response){
            $scope.clientSnippets = response;
        });
    }
});


