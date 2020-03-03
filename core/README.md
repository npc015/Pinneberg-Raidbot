# PHP Core Telegram for Pokemon Bots

PHP Core Telegram for Pokemon Bots providing core communication with Telegram and base structure for existing as well as new and yet unexisting Pokemon Bots. Developers are welcome to join https://t.me/PokemonBotSupport

# About

The PHP Core Telegram repo is required by [PokemonRaidBot](https://github.com/florianbecker/PokemonRaidBot) and [PokemonQuestBot](https://github.com/florianbecker/PokemonQuestBot).

# Git clone

It is recommended to look at the READMEs from the Bots which require the PHP Core Telegram stuff.

If you only need the PHP Core Telegram repo, you can clone it the following way.

`git clone https://github.com/florianbecker/php.core.telegram.git`

# Access permissions

## Permissions overview

The following table shows the permissions you need for core commands to work.

For more information about bot permissions, take a look at the bot readme itself. 

| Access     | **Action and /command**                                          | Permission inside access file            |
|------------|------------------------------------------------------------------|------------------------------------------|
| Config     | Get defined config options                                       | `config-get`                             |
|            | Set defined config options                                       | `config-set`                             |

# Usage

## Bot commands

Any command which is provided by the PHP Core Telegram can be used by any bot relying on the PHP Core Telegram.

### Command: /getconfig

Any bot using the PHP Core Telegram will be able to get specially configured config options via Telegram.

To define these options enter them in the bots `telegram.json` in the config folder of the bot.

Once defined you will be able to get the values via Telegram.

For example to check if the cleanup is enabled or disabled, you add the option to the `telegram.json` inside the config folder of the bot as first step. For example: `"ALLOWED_TELEGRAM_OPTIONS":"CLEANUP"`

To get the value then from Telegram, you can easily use `/getconfig`. The bot will answer and show you the current configuration of each value, e.g. `CLEANUP = false`


### Command: /setconfig

Any bot using the PHP Core Telegram will be able to set specially configured config options via Telegram.

To define these options enter them in the bots `telegram.json` in the config folder of the bot.

Once defined you will be able to change the value via Telegram.

For example to enable or disable the cleanup via Telegram, you add the option to the `telegram.json` inside the config folder of the bot as first step. For example: `"ALLOWED_TELEGRAM_OPTIONS":"CLEANUP"`

To change the value then from Telegram, you can easily use `/setconfig` providing the option and the new value, e.g. `/setconfig CLEANUP true`.

The bot will then change the current configuration for the option you submitted and show you the old and the new value of it. 

Per default any input (characters, numbers, ...) is accepted for each config option. To restrict input for a specific option, just add them to one of the restriction options in the `telegram.json` inside the bot config folder.

You can restrict the input to boolean `ALLOW_ONLY_TRUE_FALSE` or numbers `ALLOW_ONLY_NUMBERS`, e.g. `"ALLOW_ONLY_TRUE_FALSE":"CLEANUP"`.

Example input: `/setconfig CLEANUP true`

Example response: ```
Configuration updated!

CLEANUP:
Old value: false
New value: true
```

As some config options may have long or cryptic names you can easily define own names (aliases) for any config option which even allows you localized config option names!

Therefore create a file named `alias.json` inside the config folder of your bot and put the name and the alias you like to use into the file in a valid JSON format.

Example alias.json: ```
{
  "CLEANUP":"PUTZEN",
  "CLEANUP_SECRET":"PUTZPASSWORD"
}
```

Now you can simply use the alias `PUTZEN` to enable or disable the cleanup. Of course, using the original config option name `CLEANUP` is still possible!

So `/setconfig PUTZEN true` and `/setconfig CLEANUP true` will both work and change the value for the corresponding cleanup config option.
