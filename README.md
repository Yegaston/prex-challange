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

