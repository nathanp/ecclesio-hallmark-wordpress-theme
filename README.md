# Developer Readme

##### If you are looking for documentation on how to setup and use the theme, see our documentation on https://eccles.io

## Philosophy

- _Presentation_ - Themes are for presentation, not functionality.
- _Functionality_ - Something that adds functionality needs to be in our plugin, unless the functionality provides something unique to this theme.
- _Speed_ - Keep the theme as lightweight as possible.
- _Options_ - We don't provide endless, confusing option panels. This theme was developed with Churches in mind, so the options provided are relevant and simple.
- _Customizer_ - Universal options and styling options are in the Customizer as much as possible.
- _Page Options_ - Idividual page options are in the page edit screen as much as possible.
- _Portability_ - You can easily change your theme without losing your content.
- _Extendability_ - Want to customize this theme's code? Great! **Don't edit this theme's files. Create a child theme instead.** We have focused on using frameworks and tooling that are widely used and well documented, balancing the lastest/fastest features along with ease of understanding. We do not require knowledge of package managers or build tools. If that fits your style, you can incorporate that into your build, but we want this to be as accessible as possible.
  - Bootstrap 4
  - HTML
  - CSS
- _Editing_ - We are incorporating compatibility with Gutenberg and Advanced Custom Fields to make content as easy to edit as possible.

# Needed Plugins

- Theme won't break without these plugins, but key functionality will be gone.
- Advanced Custom Fields PRO _(page options)_
- Church Theme Content _(Sermons, Events, Locations, People)_
- Eccles.io Admin _(Our custom admin to make things easier for church staff/volunteers)_
- Ultimate Fonts _(Google Fonts for the Customizer)_

# Updates

Updates are managed via kernl.us

- Update style.css and kernl.version when updating versions
- ACF - Using ACF's local JSON feature to store field settings in the inc/acf-json folder. This allows everyon to receive ACF field updates automatically and puts it all in version control.
- Ready to distribute - ZIP folder, exclude the .git and node_modules folders. Exclude the .gitignore and README files.
- On Windows with 7zip installed, run `"C:\Program Files\7-Zip\7z.exe" a -tzip ecclesio-v1.x.x.zip ecclesio\ -mx9 -xr!.git -xr!.gitignore -xr!node_modules`
- _Want to set up Contiual Integration with BitBucket soon_
