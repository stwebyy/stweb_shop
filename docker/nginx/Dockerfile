FROM node:14.2-alpine as node
FROM nginx:1.19-alpine
LABEL maintainer="stweb"
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ=UTC

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++

COPY --from=node /usr/local/bin /usr/local/bin
COPY --from=node /usr/local/lib /usr/local/lib
COPY --from=node /opt /opt

COPY ./default.conf /etc/nginx/conf.d/

WORKDIR /work/backend
