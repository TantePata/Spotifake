package com.pugicorn.spotifake_server.controller;

import com.pugicorn.spotifake_server.entity.Friend;
import com.pugicorn.spotifake_server.entity.User;
import com.pugicorn.spotifake_server.mapper.FriendRepository;
import okhttp3.OkHttpClient;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.List;
import java.util.Map;
import java.util.Optional;

@Controller    // This means that this class is a Controller
@RequestMapping(path="/friend") // This means URL's start with /demo (after Application path)
public class FriendController {
    @Autowired // This means to get the bean called userRepository
    // Which is auto-generated by Spring, we will use it to handle the data
    private FriendRepository friendRepository;

    @PostMapping(path="") // Map ONLY POST Requests
    public @ResponseBody
    String addFriend (@RequestBody Map<String, Object> payload) {
        String user1 = payload.get("user1").toString();
        String user2 = payload.get("user2").toString();
        String username = payload.get("username").toString();
        String avatarUrl = payload.get("avatarUrl").toString();

        Friend f = new Friend();
        f.setUser1(user1);
        f.setUser2(user2);
        f.setUsername(username);
        f.setAvatarUrl(avatarUrl);
        f.setState("pending");

        friendRepository.save(f);
        return "ok";
    }

    @PatchMapping(path="{id}") // Map ONLY POST Requests
    public @ResponseBody
    Friend changeFriend (@RequestBody Map<String, Object> payload,
                         @PathVariable String id,
                         HttpServletResponse serverResponse)
            throws IOException { OkHttpClient client = new OkHttpClient();

        String state = payload.get("user2").toString();

        Optional<Friend> myFriend = friendRepository.findById(id);

        if (myFriend.isPresent()) {
            if (state.equals("no")) {
                friendRepository.delete(myFriend.get());
                return new Friend();
            }
            myFriend.get().setState(state);
            friendRepository.save(myFriend.get());
            return myFriend.get();
        }

        serverResponse.sendError(418, "tu fait de la merde");
        return new Friend();
    }

    @GetMapping(path="/request")
    public @ResponseBody
    List<Friend> friendToAccept(@RequestParam("myId") String idUser) {
        // This returns a JSON or XML with the users
        return friendRepository.findFriendToAccept(idUser);
    }
    @GetMapping(path="")
    public @ResponseBody
    List<User> friendAcceptedAndPending(@RequestParam("myId") String idUser) {
        // This returns a JSON or XML with the users
        return friendRepository.findFriends(idUser);
    }

    @GetMapping(path="/{id}")
    public @ResponseBody
    Optional<Friend> sqdfsqdfsqdf(@PathVariable String id) {
        // This returns a JSON or XML with the users
        return friendRepository.findById(id);
    }
}