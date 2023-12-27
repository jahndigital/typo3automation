# TYPO3 CLI Tool

## Overview

This TYPO3 CLI Tool is designed to streamline the development process in TYPO3 by providing a simple command-line interface for generating essential TYPO3 classes such as models, controllers, and repositories. Inspired by Laravel's Artisan, this tool brings similar functionality to TYPO3 projects.

## Features

- **Model Generation**: Quickly create model classes in the `Classes/Domain/Model` directory.
- **Controller Generation**: Easily generate controller classes in the `Classes/Controller` directory.
- **Repository Generation**: Simplify the creation of repository classes in the `Classes/Domain/Repository` directory.
- **Customizable Namespace**: Set your vendor and package name for namespacing your classes.

## Installation

Clone the repository or download the source code to your local machine. Ensure you have PHP installed on your system.

```bash
git clone https://github.com/jahndigital/typo3automation.git
```

## Run Composer to install dependencies:
```bash
composer install
```

## Usage
Run the tool from the command line, passing in the appropriate command and arguments.

### Creating a Model
```bash
php typo3automation.php make:model Person
```

This command creates a model class named Person.php in Classes/Domain/Model.


### Creating a Controller
```bash
php typo3automation.php make:controller PersonController
```

This command creates a controller class named PersonController.php in Classes/Controller.


### Creating a Repository
```bash
php typo3automation.php make:repository PersonRepository
```

This command creates a repository class named PersonRepository.php in Classes/Domain/Repository.

## Configuration
Upon first execution of any command, you will be prompted to enter the vendor and package name. This information is used to set the namespace in your generated classes.

## Contributing
Feel free to fork the repository, make changes, and submit pull requests. For major changes, please open an issue first to discuss what you would like to change.
