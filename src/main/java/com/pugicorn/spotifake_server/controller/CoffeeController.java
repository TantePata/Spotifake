package com.pugicorn.spotifake_server.controller;


import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

@Controller    // This means that this class is a Controller
@RequestMapping(path="/coffee") // This means URL's start with /demo (after Application path)
public class CoffeeController {

    @GetMapping(path="")
    public @ResponseBody
    int getCoffee() {
        // This returns a JSON or XML with the users
        return 418;
    }
}