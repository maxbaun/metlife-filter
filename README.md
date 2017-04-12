# Wordpress Plugin Boilerplate

~Current Version:1.0.0~

### 1. Goal

To develop a plugin for the Metlife Producers Portal to be able to filter content site wide.

### 2. Description

This plugin will show a filter bar at the top of dedicated pages. It will remember your selections as you move around the site. When
on search pages, the filters will also be applied to the search results (advanced search & regular searches). The filter will factor in
the appointed_states and agent_channel taxonomies as well as a text-based search box. Full list of conteht that the plugin will filter are:
- search results
-- advanced & search pages
- sidebar on search results pages
- sidebar on single article
- suggested articles on single article
- all content on home page
- upcoming training on the home page
- custom post types
-- events
-- product updates
-- sales promotions
-- field management updates

### 2. Features

UI
- shortcode to render the plugin dropdown UI
- shortcode to render collapse button
-- this will have an animation collapse down
- shortcode to render to plugin search box UI
- shortcode to render the search icon
-- this will have an animation collapse from the right
- dropdown to select multiple appointed_states
- dropdown to select multiple agent_channels
- search box in the filter
- apply button

Backend Options
- advanced search page
- disable on post type archives
- disable on certain pages
- disable on certain posts
- exclude values from the appointed_state taxonomies
- exclude values from the agent_channels taxonomies

User Dropdowns
- each of these will show all of the taxonomies
- will NOT show excluded values from the admin Options
- will have an All selection that toggles all of the items

Search Box
- text box
- when you hit enter it should take you to the search page

Filter Apply
- this will call an ajax funtion that will set the cookies in the browser
- on return, the page will reload

Search Apply
- will take you to the ?s=searchQuery page
- IF filters are present, this content will also be filtered

On Page Load (pre query)
- this will filter ALL content and apply the custom taxonomy
