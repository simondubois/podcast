
<p align="center">
    <img src="https://raw.githubusercontent.com/simondubois/podcast/master/screenshot.jpg">
</p>

<p align="center">
    Simple file-based podcast publisher.<br>
</p>

<div align="center">
    In the wild:
</div>

<div align="center">
    https://ovsg.dubandubois.com
</div>

<div align="center">
    https://ovsg2.dubandubois.com
</div>

<div align="center">
    https://erner.dubandubois.com
</div>

<div align="center">
    https://meurice.dubandubois.com
</div>

<div align="center">
    https://rolenplay.dubandubois.com
</div>

<div align="center">
    https://rvax.dubandubois.com
</div>

## Status

[![Maintainability](https://api.codeclimate.com/v1/badges/d3ca9d710ac16c4ab921/maintainability)](https://codeclimate.com/github/simondubois/podcast/maintainability)

This application is now considered as stable.
No more features are planned, but feel free to suggest some if you need.
Feature, fix, UX, logo, translation... any help is welcome !

## Features...

### ....for end users

- short feed description in the homepage.
- list of podcasts currently in the feed in the homepage.
- archives sorted per folder.
- possibility to listen any episode from the web browser.
- link to the RSS feed.
- responsive design.

### ...for administrator

- database free application.
- recursive file search.
- configurable without development (release frequency, theme, locale, timezone).
- built on [Lumen 6.0](https://lumen.laravel.com/docs/5.8) and [Bootstwatch 4.3](https://bootswatch.com).

## Requirements

- a web server (tested with Apache).
- PHP >= 7.2.
- [composer](https://getcomposer.org/).

## Deployment

1. Download the code to an empty folder:
```bash
git clone git@github.com:simondubois/podcast.git /var/www/podcast
```
2. Create the configuration file:
```bash
cd /var/www/podcast && cp .env.example .env
```
3. Set configuration in `.env`:
    - `APP_KEY` is a random generated string (for example `5YPcB9vVuxWf1YyjJgKhEVSg7ggvL+fD`).
    - `APP_TIMEZONE` is the timezone (for example `Europe/Paris`).
    - `APP_LOCALE` is the locale (`en` or `fr`).
    - `PODCAST_ROOT` is the path to audio files  (absolute path).
    - `PODCAST_START` is the date and time the first episode is published at (timestamp).
    - `PODCAST_LENGTH` is the number of episodes available in the feed (integer).
    - `PODCAST_INTERVAL` is the unit of `PODCAST_FREQUENCY` between two releases (`hour`, `day`, `week` or `month`).
    - `PODCAST_FREQUENCY` is the number of `PODCAST_INTERVAL` between two releases (integer or decimal).
    - `PODCAST_TITLE` is the podcast feed title.
    - `PODCAST_DESCRIPTION` is podcast description.
    - `PODCAST_IMAGE` is the podcase image URL (optional).
    - `PODCAST_THEME` is the theme for the web interface (see https://bootswatch.com).

5. Install the dependencies:
```bash
composer install --optimize-autoloader --no-dev
```
6. Point the web server to `/var/www/podcast/public`.

## FAQ

### How to upload episodes?

> This feature is not implemented, and there is no plan to implement it in the future. This is a [KISS](https://en.wikipedia.org/wiki/KISS_principle) project focusing on publishing audio, not managing files.
>
> To upload episodes, you have several options:
> - (S)FTP or any file manager provided by your hosting.
> - sync a server folder with a local folder.
> - sync a server folder with a file hosting service.
> - sync a server folder with a personal cloud service.
> - fork the project and implement the feature.

### How are episodes sorted?

> Episodes are sorted following the alphabetical order of their path relative to `PODCAST_ROOT`.
>
> You are free to name folders and episodes as it suits you.
> If you decide to name the file with the date format `YYYY-MM-DD`, the episode title will be the long date format in the locale defined by `APP_LOCALE`.

### How to publish a new episode every... ?

> The release schedule is based on 3 settings:
> - `PODCAST_START`: date for the first episode. The two other settings will start counting from this value.
> - `PODCAST_INTERVAL`: iteration length. Repeated `PODCAST_INTERVAL` times betwwen each release.
> - `PODCAST_FREQUENCY`: number of iteration between each release. The value is multiply by the duration of `PODCAST_FREQUENCY` to wait for the next release.
>
> | Examples       | `PODCAST_INTERVAL` | `PODCAST_FREQUENCY` |
> | -------------- | :----------------: | :-----------------: |
> | Every day      | `day`              | `1`                 |
> | Every two days | `day`              | `2`                 |
> | Twice per week | `day`              | `3.5`               |
> | Twice per week | `week`             | `0.5`               |
> | Every week     | `week`             | `1`                 |
> | Every two week | `week`             | `2`                 |
>

### What about authentication?

> Authentication either requires a database or an external service. Also, authentication requires additional features like lost passwords and account activation.
> This is a [KISS](https://en.wikipedia.org/wiki/KISS_principle) project focusing on publishing audio, avoiding any complexity.
>
> If you want authentication, I recommend you to setup [Basic access authentication](https://en.wikipedia.org/wiki/Basic_access_authentication) at the server level.
