var elementsApp = angular.module('elementsApp', ['ui.router','ui.bootstrap','ngAnimate']);

elementsApp.config(function($stateProvider, $urlRouterProvider) {
    
    $urlRouterProvider.otherwise('/');
    
    $stateProvider

    // home view
    .state('home', {
        url: '/',
        views: {
            '': { templateUrl: 'partials/home.html' },
            'table@home': {
                templateUrl: 'partials/table.html',
                controller: 'tableCtrl'
            }
        }
    })
});

// main controller
elementsApp.controller('mainCtrl', function($scope){
    
});

// table controller
elementsApp.controller('tableCtrl', function($scope){
    $.getJSON('http://mendelements.com/json/periodicTable.json', function(result){
        var table = result.table,
        lanthanoids = result.lanthanoids,
        actinoids = result.actinoids

        var tableDiv = $('.ptoe');

        var ptoe = {
            elementClass: 'element',
            groupList: ['Transition','Basic','Alkaline','Alkali','Metalloid','Nonmetal','Halogen','Noble','Lanthanoid','Actinoid'],
            normalPeriods: function(periodList){
                for(var i=0; i<periodList.length; i++){
                    var elements = periodList[i].elements;
                    var periodDiv = $('<div class="row period"></div>');

                    for(var j=0; j<elements.length; j++){
                        var elementClasses = this.elementClass;
                        var position = elements[j].position;
                        if(position > 0){
                            var prevPosition = elements[j-1].position;
                            var positionDiff = position - prevPosition;
                            if(positionDiff > 1){
                                for(var k=1; k<positionDiff; k++){
                                    periodDiv.append('<div class="'+ elementClasses +' spacer"></div>');
                                }
                            }
                        }
                        var elementData = elements[j];

                        var elementName = elementData.name;
                        if(elementName == ''){
                            elementClasses = elementClasses +" elementRange";
                            var elementDiv = $('<div class="'+ elementClasses +'"></div>');
                            elementDiv.append($('<p class="range">'+ elementData.small +'</p>'))
                        }
                        else {
                            var elementGroup = elementData.group;

                            for(var k=0; k<this.groupList.length; k++){
                                if(elementGroup.indexOf(this.groupList[k]) !== -1){
                                    var elementType = this.groupList[k].toLowerCase();
                                    elementClasses = elementClasses +" "+ elementType;
                                    break;
                                }
                            }

                            var elementSymbol = elementData.small;

                            if(elementSymbol.length > 2){
                                elementClasses = elementClasses +" smallSymbol";
                            }

                            var elementDiv = $('<div class="'+ elementClasses +'"></div>');
                            elementDiv.append($('<p class="atomicNum">'+ elementData.number +'</p><br><p class="symbol">'+ elementData.small +'</p><br><p class="chemical">'+ elementData.name +'</p><br><p class="mass">'+ elementData.molar +'</p>'));

                        }
                        periodDiv.append(elementDiv);
                    }
                    tableDiv.append(periodDiv);
                }
            },
            radioactivePeriod: function(periodName){
                var radioactiveDiv = $('<div class="row period radioactive"></div>');

                for(var i=periodName.length-1; i>=0; i--){
                    var elementData = periodName[i];
                    var elementClasses = this.elementClass;

                    var elementGroup = elementData.group;

                    for(var k=0; k<this.groupList.length; k++){
                        if(elementGroup.indexOf(this.groupList[k]) !== -1){
                            var elementType = this.groupList[k].toLowerCase();
                            elementClasses = elementClasses +" "+ elementType;
                            break;
                        }
                    }

                    var elementDiv = $('<div class="'+ elementClasses +'"></div>');
                    elementDiv.append($('<p class="atomicNum">'+ elementData.number +'</p><br><p class="symbol">'+ elementData.small +'</p><br><p class="chemical">'+ elementData.name +'</p><br><p class="mass">'+ elementData.molar +'</p>'));
                    
                    radioactiveDiv.append(elementDiv);
                }
                tableDiv.append(radioactiveDiv);
            }
        };

        ptoe.normalPeriods(table);
        ptoe.radioactivePeriod(lanthanoids);
        ptoe.radioactivePeriod(actinoids);

        $('.element').on('click', function(){
            if($(this).hasClass('selected')){
                $(this).removeClass('selected');
            }
            else {
                $(this).addClass('selected');
            }
        });

    });


});