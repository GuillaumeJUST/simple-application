# Simple PHP Application

This is a simple php application with unit test.

# Contents

 - PHPUnit
 - php example
 
# Prerequisites

 - PHP V 7.2
 - Composer
 
 Or 
 
  - Docker
 
# Installation

Copy the code or fork the repository

# Running 
 
    composer install
    php index.php
    
Or with docker

    docker build -t simple-application .
    docker run -it --rm --name my-running-simple-application simple-application

# Test

    composer test
   
With coverage

    composer coverage
