# Card Mini Game WordPress Plugin 🎴✨

Welcome to the enchanting world of the Card Mini Game WordPress Plugin! Designed with creativity and user engagement at its heart, this plugin is your gateway to adding a mesmerizing card game experience to your WordPress site. Whether you aim to entertain, engage, or even provide therapeutic insights through tarot readings, this plugin is versatile enough to meet a wide array of needs.

Donate link: https://mesvak.software/
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

## 🌟 Key Features

- **Tarot Card Magic**: Originally crafted for a therapy clinic using tarot cards, our plugin supports a deck of 80 beautifully designed cards, offering a rich tapestry of imagery and insights for your users.
- **Elegant Display**: Watch as the cards fan out elegantly on your page, inviting users to browse, select, and interact with them in a visually stunning display.
- **Interactive Fun**: Users can select cards, shuffle the deck, and even prepare them for future use, such as sending through email for personalized readings.
- **Exclusive Admin Powers**: Admins wield the ability to create three distinct sets or piles of cards, providing an extra layer of customization and control over the game experience.
- **Flexible Selection**: While regular users can embark on a journey by picking 7 cards, admins have the liberty to select any number of cards, tailoring the experience to their desire.

## 🚀 Quick Start Guide

### Installation

Embark on your adventure with the Card Mini Game plugin by:

- **Manual Upload**: Download and manually upload the plugin to your WordPress site.
- **WordPress Store**: Stay tuned! A simpler installation option through the WordPress store is on its way.

### How to Use

#### Displaying the Cards

Bring the magic to your page with the simple addition of the shortcode `[display_cards]`, and let the cards captivate your audience.

#### Selecting and Shuffling Cards

To enable the heart of the game, integrate the following HTML snippets:

```html
<div class="picked-cards-container" style="display: flex; overflow-x: auto;">Picked cards will appear here.</div>
<button id="shuffle-button" class="btn shuffle-btn">Shuffle Card</button>
```

For a destiny-driven selection of cards:
```html
<input type="number" id="num-cards1-input" value="7" class="input-field" min="1" max="35">
<button id="pick-seven-cards-button" class="btn hypnotic-btn">Pick Cards</button>
```
#### Admin-Only Card Sets
Admins can create and display unique sets of cards with:
```html
<div id="cards-display"></div>
<button id="show-cards">Show</button>
```
## 🎨 Open Source and Customization

Dive into customization with our open-source CSS and JavaScript code. Tailor the plugin to your heart’s desire, enhancing the user experience on your site. Integration with OpenAI offers a customizable gateway to send the mystical insights of selected cards directly to your users or customers

## 📚 Database Compatibility

Our plugin uses a sanitized database named cards, ensuring compatibility with any ASCII characters you input for name, icon, description, or long description.

## 🌈 Make Your WordPress Site Spellbinding

Elevate your WordPress site with the Card Mini Game plugin! Whether for entertainment, engagement, or a touch of magic, this plugin promises to transform your site into a captivating realm of card games. Let the adventure begin! 🚀✨
