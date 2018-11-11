package com.pugicorn.spotifake_server.controller;


import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.pugicorn.spotifake_server.entity.User;
import com.pugicorn.spotifake_server.mapper.UserRepository;
import okhttp3.Call;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.List;
import java.util.Map;
import java.util.Optional;

@Controller    // This means that this class is a Controller
@RequestMapping(path="/user") // This means URL's start with /demo (after Application path)
public class UserController {
    @Autowired // This means to get the bean called userRepository
    // Which is auto-generated by Spring, we will use it to handle the data
    private UserRepository userRepository;

    @PostMapping(path="") // Map ONLY POST Requests
    public @ResponseBody
    String test (@RequestBody Map<String, Object> payload,
                 HttpServletResponse serverResponse) throws IOException {
        OkHttpClient client = new OkHttpClient();

        String token = payload.get("token").toString();

        Request request = new Request.Builder()
                .url("https://api.spotify.com/v1" + "/me")
                .addHeader("authorization", "Bearer " + token)
                .build();

        Call call = client.newCall(request);
        Response response = call.execute();

        if (response.code() == 200) {
            User n = new User(response.body().string());
            Optional<User> myUser = userRepository.findById(n.getId());
            if (! myUser.isPresent()){
                userRepository.save(n);
            }
            return n.getId();
        } else {

            JsonElement jelement = new JsonParser().parse(response.body().string());
            JsonObject jobject = jelement.getAsJsonObject();

            serverResponse.sendError(response.code(), jobject.getAsJsonObject("error").get("message").toString());
            return "bidon";
        }

    }


    @GetMapping(path="")
    public @ResponseBody
    List<User> getAllUsers(@RequestParam("name") String username) {
        // This returns a JSON or XML with the users
        return userRepository.findUsersByUsername(username);
    }

    @GetMapping(path="/{id}")
    public @ResponseBody
    Optional<User> getUer(@PathVariable String id) {
        // This returns a JSON or XML with the users
        return userRepository.findById(id);
    }
}