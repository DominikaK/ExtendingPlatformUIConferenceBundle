YUI.add('ezconf-listview', function (Y) {
    // Good practice: use a custom namespace 'eZConf' here
    Y.namespace('eZConf');

    // Make sure the first parameter of Y.Base.create() (internal name) is unique
    // it is used for 3 things in PlatformUI:
    // * to identify the view if one wants to write a plugin for it
    // * to find the corresponding template
    // * to generate a CSS class on its container to ease styling
    Y.eZConf.ListView = Y.Base.create('ezconfListView', Y.eZ.View, [], {
        initializer: function () {
            console.log("Hey, I'm the list view");
        },

        render: function () {
            // this.get('container') is an auto generated <div>
            // here, it's not yet in the DOM of the page and it will be added
            // after the execution of render().
            this.get('container').setContent(
                "Hey, I'm the listView and I was rendered it seems"
            );
            this.get('container').setStyles({
                background: '#fff',
                fontSize: '200%',
            });
            return this;
        },
    });
});
