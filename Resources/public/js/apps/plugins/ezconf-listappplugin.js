YUI.add('ezconf-listapplugin', function (Y) {
    // Good practices:
    // * use a custom namespace 'eZConf' here
    // * put the plugins in a 'Plugin' sub namespace
    Y.namespace('eZConf.Plugin');

    Y.eZConf.Plugin.ListAppPlugin = Y.Base.create('ezconfListAppPlugin', Y.Plugin.Base, [], {
        initializer: function () {
            var app = this.get('host'); // the plugged object is called host

            console.log("Hey, I'm a plugin for PlatformUI App!");
            console.log("And I'm plugged in ", app);
        },
    }, {
        NS: 'ezconfTypeApp' // don't forget that
    });

    // registering the plugin for the app
    // with that, the plugin is automatically instanciated and plugged in
    // 'platformuiApp' component.
    Y.eZ.PluginRegistry.registerPlugin(
        Y.eZConf.Plugin.ListAppPlugin, ['platformuiApp']
    );
});
