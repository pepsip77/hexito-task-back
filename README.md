
# Hexito task- Crypto converter

User story
As a user I want to be able to convert EUR, USD or PLN to ANY crypto.

### Success Flow
- Navigate to app
- I see 3 input fields
- Amount input (number)
- currency select (EUR, USD, PLN)
- crypto input (I can manually input: ETH, BTC, ADA or etc.)
- Submit button
- After submitting I should see some text on how much I’ll get crypto for that amount of
  money.

### Tech requirements
- Modern PHP framework
- Modern CSS framework
- Vue.js/React.js in front
- API first approach (Exposed API, without auth)
- Possibility to switch Crypto Clients (Implement interface).
- Store user input and calculated amounts to the database.
- README.md on how to launch app

Crypto API to use: https://exchangerate.host/#/docs

## Requirements
- PHP 8.1

## How to run
- Run ```composer install```
- Fill .env file based on .env.example
- Run project using ```php artisan serve```
