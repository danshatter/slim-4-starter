(function() {
    "use strict";

    // The UI controller. It handles everything concerning the display 
    const UI = (function(){

        return {

        }

    })();

    // The Storage Controller. It handles everything concerning localStorage
    const Storage = (function() {

        return {

            
        }

    })();

    // The App Initializer. It brings the UI and Storage Controllers together
    const App = (function(ui, storage) {

        // All event listeners go here
        function loadEventListeners() {

        }

        return {

            init() {
                loadEventListeners();
            }

        }

    })(UI, Storage);

    // Application Initialization
    App.init();
})();