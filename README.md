# Buffalo Research Digital Data Repository

Welcome to the Buffalo Research Digital Data Repository, a web-based application developed by the Bangladesh Livestock Research Institute under the Ministry of Fisheries and Livestock. This repository is designed to streamline research, management, and data analysis for the buffalo farming industry. Leveraging PHP 8, Laravel 10, AJAX, JavaScript, jQuery, and Bootstrap, it offers a powerful solution for buffalo researchers and farmers.

## Table of Contents

1. [Introduction](#introduction)
2. [Key Features](#key-features)
3. [System Requirements](#system-requirements)
4. [Installation Guide](#installation-guide)
5. [Configuration](#configuration)
6. [Usage](#usage)
7. [Contributing](#contributing)
8. [License](#license)

## Introduction

The Buffalo Research Digital Data Repository is a comprehensive system designed for buffalo farming and research. It empowers users to manage, analyze, and derive insights from buffalo-related data, including farm settings, animal records, health management, and reporting.

## Key Features

### Farm Settings

- **Research Farm:** Create and manage research farm profiles.
- **Community Farm:** Establish and update community farm records.
- **Individual Farm:** Maintain records of individual farms.
- **Animal Category:** Define and categorize animals.
- **Disease & Clinical Sign:** Manage diseases and clinical signs.

### Animal Record

- **Animal Info:** Record general information about each buffalo.
- **Morphometric:** Capture morphometric measurements.
- **Calves Body Weight:** Monitor body weight data for calves.
- **Reproduction:** Maintain mating and pregnancy records.
- **Milk Production:** Document milk production data.
- **Milk Composition:** Record milk composition.
- **Semen Analysis:** Manage semen analysis data.
- **Service:** Track animal services.
- **Distribution:** Archive data about buffalo distribution.
- **Culling:** Log culling information.

### Health Management

- **Disease and Treatment:** Document disease occurrences and treatments.
- **Vaccination:** Manage vaccination records.
- **Deworming:** Record deworming activities.
- **Parasite:** Track parasitic infections and treatments.

### Reporting

Generate customized reports for various aspects of buffalo management, health, and research.

## System Requirements

Ensure your server meets these requirements:

- PHP 8
- Laravel 10
- Web server (e.g., Apache, Nginx)
- MySQL database
- Composer (for PHP dependency management)

## Installation Guide

1. Clone this repository:

   ```shell
   git clone https://github.com/your/repository.git

2. Clone this repository:

   ```shell
   composer install
    ```
3. Create a `.env` file from `.env.example` and configure it with your database settings:

   ```shell
   cp .env.example .env 
   ```  
   Update .env with your database credentials.
4. Generate an application key:

   ```shell
   php artisan key:generate
    ```
6. Run database migrations and seeders:

   ```shell
   php artisan migrate --seed
    ```
7. Start the development server:

   ```shell
   php artisan serve
   ```
Access the repository at http://localhost:8000.

## Configuration
Customize the repository by modifying .env to suit your requirements.

## Usage
Detailed instructions and guides are available in the application's user documentation. Sections include Farm Settings, Animal Record, Health Management, and Reporting.

## Contributing
I welcome contributions. To contribute, fork this repository, create a new branch, make your changes, and submit a pull request.

1. **Fork the Repository.**
2. Create a new branch for your feature or bug fix: `git checkout -b feature/your-feature-name`.
3. Implement your changes and commit them: `git commit -m "Add your feature"`.
4. Push your changes to your fork: `git push origin feature/your-feature-name`.
5. Create a pull request to the main repository.

## Contact

For any inquiries or assistance, please feel free to reach out to the project maintainers:

- Email: msh.shafiul@gmail.com
- Website: www.softgiantbd.com

