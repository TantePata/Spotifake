package com.pugicorn.spotifake_server.controller;


import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.pugicorn.spotifake_server.entity.Playlist;
import com.pugicorn.spotifake_server.entity.PlaylistTrack;
import com.pugicorn.spotifake_server.entity.Track;
import com.pugicorn.spotifake_server.entity.User;
import com.pugicorn.spotifake_server.mapper.PlaylistRepository;
import com.pugicorn.spotifake_server.mapper.PlaylistTrackRepository;
import com.pugicorn.spotifake_server.mapper.TrackRepository;
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
import java.util.*;
import java.util.stream.Collectors;

@Controller    // This means that this class is a Controller
@RequestMapping(path = "/playlist") // This means URL's start with /demo (after Application path)
public class PlaylistController {
    @Autowired
    private PlaylistRepository playlistRepository;

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private TrackRepository trackRepository;

    @Autowired
    private PlaylistTrackRepository playlistTrackRepository;

    @GetMapping(path = "")
    public @ResponseBody
    List<Playlist> getAllUserPlaylist(
            @RequestHeader Map<String, String> header,
            HttpServletResponse serverResponse,
            @RequestParam("name") String username)
            throws IOException {

        OkHttpClient client = new OkHttpClient();

        String token = header.get("token");

        Request request = new Request.Builder()
                .url("https://api.spotify.com/v1" + "/me/playlists?limit=50&offset=0")
                .addHeader("authorization", "Bearer " + token)
                .build();

        Call call = client.newCall(request);
        Response response = call.execute();

        List<Playlist> listPlayToAdd = new ArrayList<>();
        List<Playlist> listPlayAllObject = new ArrayList<>();
        List<User> listUsertToInsert = new ArrayList<>();
        List<Track> listTrackToInsert = new ArrayList<>();
        List<PlaylistTrack> playlistTrackList = new ArrayList<>();
        List<String> listIdPlaylist = new ArrayList<>();
        List<String> listIdTrack = new ArrayList<>();
        List<String> listIdUser = new ArrayList<>();

        if (response.code() == 200) {
            JsonParser jsonParser = new JsonParser();
            JsonObject objectFromString = jsonParser.parse(response.body().string()).getAsJsonObject();

            JsonArray listPlay = objectFromString.get("items").getAsJsonArray();

            HashMap<String, Playlist> playlistHashMap = new HashMap<>();

            for (JsonElement plays : listPlay) {
                Playlist p = new Playlist(plays);

                listIdPlaylist.add(p.getId());
                listIdUser.add(p.getIdUser());

                listPlayAllObject.add(p);
                playlistHashMap.put(p.getId(), p);

            }
            listIdUser = listIdUser.stream().distinct().collect(Collectors.toList());
            listIdPlaylist = listIdPlaylist.stream().distinct().collect(Collectors.toList());

            List<String> users = userRepository.findExistedUser(listIdUser);
            List<String> playlist = playlistRepository.findExistedPlaylist(listIdPlaylist);

            // on cherche les user non existant
            listIdUser.removeAll(users);
            if (listIdUser.size() > 0) {
                for (String idUser : listIdUser) {
                    Request requestUser = new Request.Builder()
                            .url("https://api.spotify.com/v1" + "/users/" + idUser)
                            .addHeader("authorization", "Bearer " + token)
                            .build();

                    Call callUser = client.newCall(requestUser);
                    Response responseUser = callUser.execute();

                    User n = new User(responseUser.body().string());
                    listUsertToInsert.add(n);
                }
            }
            // la même pour les playlist
            listIdPlaylist.removeAll(playlist);

            if (listIdPlaylist.size() > 0) {

                HashMap<String, Track> trackHashMap = new HashMap<>();
                for (String idPlay: listIdPlaylist){
                    listPlayToAdd.add(playlistHashMap.get(idPlay));

                    // Si on a pas la playlist on recup les chanson pour les add
                    Request requestTracks = new Request.Builder()
                            .url("https://api.spotify.com/v1" + "/playlists/" + idPlay + "/tracks"
                            + "?fields=items(track(id,name,artists,album(name,images),preview_url))&imit=100&offset=0"
                            )
                            .addHeader("authorization", "Bearer " + token)
                            .build();

                    Call callTracks = client.newCall(requestTracks);
                    Response responseTracks = callTracks.execute();

                    objectFromString = jsonParser.parse(responseTracks.body().string()).getAsJsonObject();

                    JsonArray listTracks = objectFromString.get("items").getAsJsonArray();

                    for (JsonElement track : listTracks) {
                        Track t = new Track(track);
                        listIdTrack.add(t.getId());
                        trackHashMap.put(t.getId(), t);

                        playlistTrackList.add((new PlaylistTrack(idPlay, t.getId())));
                    }
                }
                listIdTrack = listIdTrack.stream().distinct().collect(Collectors.toList());
                List<String> track = trackRepository.findExistedtrackId(listIdTrack);
                listIdTrack.removeAll(track);
                if (listIdTrack.size() > 0) {
                    for (String idTrack : listIdTrack) {
                        listTrackToInsert.add(trackHashMap.get(idTrack));
                    }
                }
            }

            userRepository.saveAll(listUsertToInsert);
            playlistRepository.saveAll(listPlayToAdd);
            trackRepository.saveAll(listTrackToInsert);
            playlistTrackRepository.saveAll(playlistTrackList);
        } else {

            JsonElement jelement = new JsonParser().parse(response.body().string());
            JsonObject jobject = jelement.getAsJsonObject();

            serverResponse.sendError(response.code(), jobject.getAsJsonObject("error").get("message").toString());
        }

        return listPlayAllObject;
    }
}