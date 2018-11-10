package com.pugicorn.spotifake_server.entity;

import com.google.gson.*;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "user")
public class User {
    @Id
    private String id;

    @Column(name = "username")
    private String username;

    @Column(name = "avatar_url")
    private String avatarUrl;

    @Column(name = "token")
    private String token;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getAvatarUrl() {
        return avatarUrl;
    }

    public void setAvatarUrl(String avatarUrl) {
        this.avatarUrl = avatarUrl;
    }

    public String getToken() {
        return token;
    }

    public void setToken(String token) {
        this.token = token;
    }

    public User(String jsonString, String token) {
        JsonElement jelement = new JsonParser().parse(jsonString);
        JsonObject jobject = jelement.getAsJsonObject();

        this.id = jobject.get("id").toString().substring(1, jobject.get("id").toString().length() - 1 );
        this.username  = (jobject.get("display_name").isJsonNull() ? this.id : jobject.get("display_name").toString().substring(1, jobject.get("display_name").toString().length() - 1 ));
        JsonArray avatarUrl = jobject.getAsJsonArray("images");
        if (avatarUrl.size() > 0) {
            this.avatarUrl = avatarUrl.get(0).getAsJsonObject().get("url").toString();
            this.avatarUrl = this.avatarUrl.substring(1,this.avatarUrl.length() - 1);
        }
    }
    public User(){}
}