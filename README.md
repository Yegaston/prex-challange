# MER
(mermaid mer)[MER.mmd]

# Diagram (😅)
(mermaid diagram)[flow_diagram.mmd]


# Deploy 

### Requirements
- MYSQL DB 
- Configure .ENV with stage data

### Build Dockerfile
docker build -t prex .
docker run --name prex_laravel -p 9000:80 prex
docker run -v ./nginx.conf:/etc/nginx/conf.d -p 4200:80 prex 

(This is not working 😢)

(Postman Collection)[https://app.getpostman.com/join-team?invite_code=65b5e87eac05781ef242421ea8dccb5a&target_code=2f380b0c804216db04445c9e60912cbb]
