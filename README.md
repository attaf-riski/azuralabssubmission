# Book Management

This Project is supposed for submission Home Test Software Engineer 2024 at Azura Lab. 

## Run Locally

Clone the project

```bash
  git clone https://github.com/attaf-riski/azuralabssubmission.git
```

Go to the project directory

```bash
  cd azuralabssubmission
```

Create Database on MySQL With name atafbookmanagement
```bash
CREATE DATABASE atafbookmanagement;
```

Run Migration

```bash
php artisan migrate
```

Install dependencies

```bash
  composer install
```

Start the server

```bash
  php artisan serve
```

