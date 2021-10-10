# conpresp-api

## Required tools

### Docker

- Install [Docker](https://www.docker.com/)
- Run the docker-compose.yml via command `docker-compose up`

## Note

Both container and image must be deleted and re-created, so it can reflect the modifications, in the following scenarios:

- The seed (`conpresp_db.sql`) is modified
- Any modification occurs in the docker-compose or dockerFile files

## Available users for testing

- ### Common

  - e-mail: comum@comum.com
  - pass: 123456

- ### Moderator

  - e-mail: moderador@moderador.com
  - pass: 123456

- ### Administrator

  - e-mail: admin@admin.com
  - pass: 123456
