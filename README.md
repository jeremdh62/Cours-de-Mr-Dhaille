# Cours de Mr Dhaille

Cette application permet de répertorier tous les cours et TP.

## Installation

Use the package manager [npm](https://nodejs.org/en/download/).

```bash
npm install
```
Use the package manager [composer](https://getcomposer.org).

```bash
composer install
```

### Usage
 Build css with npm

```bash
npm run build
```

##### create DataBase

```bash
symfony console doctrine:database:create
```

###### Make migrations

```bash
symfony console doctrine:migrations:migrate
```
