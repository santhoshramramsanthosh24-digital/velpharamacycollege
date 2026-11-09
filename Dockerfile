FROM dunglas/frankenphp:latest

WORKDIR /app

COPY . /app

ENV SERVER_NAME=":${PORT:-80}"
ENV CADDY_GLOBAL_OPTIONS="admin off"

CMD ["frankenphp", "run", "--config", "/app/Caddyfile"]
