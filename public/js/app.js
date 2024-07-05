   define([

  'jquery',
  'underscore',
  'backbone',
  'marionette', 
  'handlebars',
  'text!templates/app_view.html',

  'modules/mainMenuView/mainMenuView',
  'modules/dashboard/dashboard',
],
function ($, _, Backbone, Marionette, Handlebars, tmpl, mainMenuView, dashboard ) {


    Backbone.Marionette.TemplateCache.prototype.compileTemplate = function(rawTemplate) {

        return Handlebars.compile(rawTemplate);
    };

    var App = new Backbone.Marionette.Application();

    App.addRegions({

         main: '#main'
    });

    App.addInitializer(function() {

       this.initAppLayout();   
    });

    App.on("initialize:after", function(){

      Backbone.history.start({ pushState: true });
    });

    App.initAppLayout = function() {

        AppLayout = Backbone.Marionette.Layout.extend({

         template: tmpl,

         regions: {
             userInfo: "#userInfo",
             mainMenu: "#mainMenu",
             content: "#content"
         },

        });

        var layout = new AppLayout();
        App.main.show(layout);

        App.main.currentView.mainMenu.show(new mainMenuView.Views.menu());
        App.main.currentView.content.show(new dashboard.Views.main());    

       // this can be a main menu navigation
       // this will change content at the "main" app screen
       // your links should include the role=nav-main-app

        $('a[role=nav-main-app]').click(function(e) {
          App.Router.navigate( $(this).attr('href'), {trigger: true});
          e.preventDefault(); 
        });  

    };

    return App;

});