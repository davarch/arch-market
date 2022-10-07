<?php

it('has home page')->get('/')->assertStatus(200);
