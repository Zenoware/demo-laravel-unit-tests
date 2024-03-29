# [Demo] Laravel Unit Tests

## Overview

The goal of this repo is to demo how to write unit tests for a Laravel application, or honestly, any PHP application.
In reality, unit tests don't really require Laravel, as they are at the lowest level of testing.

Unit tests are lightweight tests that are written to test a single unit of code. Writing more unit tests can help you write better code by thinking atomically about your code.

In one of my previous roles, the developers were _also_ the testers. Because we ran our code through a battery of data providers, we were able to catch a lot of bugs before they made it to production.

That makes them very flexible and very fast. This means you can write as many as you want and run them as often as you want with negligible performance impact.

They can be written for any PHP application. However, Laravel's testing suite is quite robust and makes it easy to write tests for your application.

## Benefits of unit tests

| Type of Test | Speed | Purpose |
|--------------|-------|---------|
| Unit         | Fast  | To test a single unit of code (e.g., a function or method) in isolation from other parts of the system. |
| Feature      | Medium | To test a complete feature of the system, which may involve multiple units of code interacting together. |
| Integration  | Slow  | To test the interaction between different units of code or different systems to ensure they work together as expected. |

- Fewer feature tests needed as you can trust your code more at the most intrinsic level
- The more unit tests you write, the bigger the blueprints you have for new tests
- The more data providers you write, the more interested you become with edge cases and how your code behaves in different scenarios
- You can anticipate exceptions and errors before they happen
- Application code is more understandable because you wind writing more portable code
- Mocks and stubs can be used to isolate the code being tested
- More cognisant of dependencies and how they are used due to mocking and stubbing
- When doing a massive refactor, you can run your unit tests to see if you've broken anything

## When to **NOT** use unit tests

While unit tests are a powerful tool for validating the functionality of individual components of your code, they are not always the best choice for _every_ testing scenario. Here are some situations where you might want to use _feature_ or _integration_ tests instead:

### Complex interactions
Unit tests are designed to test a single unit of code in isolation. However, in a real-world application, different units of code often interact with each other in complex ways. If you want to test these interactions, you should use integration tests. Integration tests allow you to test the interaction between different units of code or different systems to ensure they work together as expected.

### End-to-end functionality

While unit tests are great for testing individual functions or methods, they are not designed to test a complete feature of the system. If you want to test a feature from end to end, you should use feature tests. Feature tests allow you to test a complete feature of the system, which may involve multiple units of code interacting together.

### Real-world scenarios

When doing a massive refactor, unit tests might not be sufficient to ensure that the overall functionality of the system remains intact. In such cases, feature or integration tests that cover larger parts of the system can be more effective in catching any potential issues.

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

    # (Optional) Run the tests in a specific group. Useful for exclusively running new tests on your branch.
    ./vendor/bin/sail artisan test --group=new

## Resources

- [Mockery](https://docs.mockery.io/en/latest/)
- [PHPUnit](https://phpunit.readthedocs.io/en/9.5/)
