# Maviance PHP Test

### Issues with the Codebase
1. Wrong configuration of the Dockerfile. Made some updates for it to work.
2.
### How to run console commands
```bash
# run this to fetch data from online and store into a data store
php console.php refresh:balance

# run this command to fetch data directly from the data-store by passing an account id argument
php console.php get:balance <account id> # pass an account id argument
```


Setup the docker container
```bash
docker run -it $(docker build -q .)
```
