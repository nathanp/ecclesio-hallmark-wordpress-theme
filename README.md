# Developer Readme
##### If you are looking for documentation on how to setup and use the theme, see our documentation on https://eccles.io

## Philosophy
  - *Presentation* - Themes are for presentation, not functionality.
  - *Functionality* - Something that adds functionality needs to be in our plugin, unless the functionality provides something unique to this theme.
  - *Speed* - Keep the theme as lightweight as possible.
  - *Options* - We don't provide endless, confusing option panels. This theme was developed with Churches in mind, so the options provided are relevant and simple.
  - *Customizer* - Universal options are in the Customizer as much as possible.
  - *Page Options* - Idividual page options are in the page edit screen as much as possible.
  - *Portability* - You can easily change your theme without losing your content.
  - *Extendability* - Want to customize this theme's code? Great! **Don't edit this theme's files. Create a child theme instead.**

# Needed Plugins
  - Theme won't break without these plugins, but key functionality will be gone.
  - Advanced Custom Fields PRO *(page options)*
  - Church Theme Content *(Sermons, Events, Locations, People)*
  - Eccles.io Admin *(Our custom admin to make things easier for church staff/volunteers)*
  - Ultimate Fonts *(Google Fonts for the Customizer)*

# Updates
Updates are managed via kernl.us
  - Update style.css and kernl.version when updating versions
  - ACF - Using ACF's local JSON feature to store field settings in the inc/acf-json folder. This allows everyon to receive ACF field updates automatically and puts it all in version control.
  - Ready to distribute - ZIP folder, exclude the .git and node_modules folders. Exclude the .gitignore and README files.
  - *Want to set up Contiual Integration with BitBucket soon*