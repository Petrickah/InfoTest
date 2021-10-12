FROM ubuntu:14.04

RUN echo "deb http://ppa.launchpad.net/fkrull/deadsnakes/ubuntu trusty main" > /etc/apt/sources.list.d/deadsnakes.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys DB82666C

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y \
    build-essential \
    ca-certificates \
    gcc \
    g++ \
    libpq-dev \
    pkg-config \
    python3.4 \
    python3.4-dev \
    && apt-get autoremove \
    && apt-get clean

WORKDIR /opt/solutions
ADD . ../evaluator
ENTRYPOINT [ "/usr/bin/python3.4", "-u", "../evaluator/eval.py" ]