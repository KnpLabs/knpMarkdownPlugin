The knpMarkdownPlugin is a symfony plugin that provides a markdown editor widget
based on markItUp!, with a live preview functionality.

## Installation

Copy the plugin directory in your `plugins/` or clone the git repository:

    $ git clone git://github.com/knplabs/knpMarkdownPlugin.git plugins/knpMarkdownPlugin

Enable the plugin in your `config/ProjectConfiguration.class.php`:

    public function setup()
    {
      
      ...

      $this->enablePlugins( 'knpMarkdownPlugin' );
    }

Publish the plugin assets:

    $ symfony plugin:publish-assets

Enable the knpMarkdown module in your `apps/myApp/config/settings.yml`:

    all:

      .settings:

        ...

        enabled_modules:        [default, knpMarkdown]

Clear your cache:

    $ symfony cc

