# [Demo] Laravel Unit Tests

## Overview

The goal of this repo is to demo how to write unit tests for a Laravel application, or honestly, any PHP application.
In reality, unit tests don't really require Laravel, as they are at the lowest level of testing.

Unit tests are lightweight tests that are written to test a single unit of code. Writing more unit tests can help you write better code by thinking atomically about your code.

In one of my previous roles, the developers were _also_ the testers. Because we ran our code through a battery of data providers, we were able to catch a lot of bugs before they made it to production.

That makes them very flexible and very fast. This means you can write as many as you want and run them as often as you want with negligible performance impact.

They can be written for any PHP application. However, Laravel's testing suite is quite robust and makes it easy to write tests for your application.

## Benefits of unit tests

- Fewer feature tests needed as you can trust your code more at the most intrinsic level
- The more unit tests you write, the bigger the blueprints you have for new tests
- The more unit tests you write, the more interested you become with edge cases and how your code behaves in different scenarios
- Application code is more understandable because you wind writing more portable code
- Mocks and stubs can be used to isolate the code being tested
- More cognisant of dependencies and how they are used due to mocking and stubbing
- When doing a massive refactor, you can run your unit tests to see if you've broken anything

## Getting started

### Clone this repo

    git clone git@github.com:Zenoware/demo-laravel-unit-tests.git

### Set environment variables

    cp .env.example .env

### Install composer dependencies

    composer install

### Boot the Laravel application

    ./vendor/bin/sail up

### Run the tests

    ./vendor/bin/sail artisan test

## Resources

- [Mockery](https://docs.mockery.io/en/latest/)
- [PHPUnit](https://phpunit.readthedocs.io/en/9.5/)
