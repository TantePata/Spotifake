package com.pugicorn.spotifake_server.entity;

import com.google.gson.JsonElement;
import com.google.gson.JsonObject;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "track")
public class Track {

    @Id
    private String id;

    @Column(name = "name")
    private String title;

    @Column(name = "artist")
    private String artist;

    @Column(name = "album")
    private String album;

    @Column(name = "coverUrl")
    private String coverUrl;

    @Column(name = "sampleUrl")
    private String sampleUrl;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getArtist() {
        return artist;
    }

    public void setArtist(String artist) {
        this.artist = artist;
    }

    public String getAlbum() {
        return album;
    }

    public void setAlbum(String album) {
        this.album = album;
    }

    public String getCoverUrl() {
        return coverUrl;
    }

    public void setCoverUrl(String coverUrl) {
        this.coverUrl = coverUrl;
    }

    public Track(JsonElement playlist) {

        JsonObject jobject = playlist.getAsJsonObject();
        this.id = mconcat(jobject.get("id").toString());

        this.title = mconcat(jobject.get("name").toString());

        this.artist = jobject.get("images").getAsJsonArray().get(0).getAsJsonObject().get("url").toString();
        this.artist = mconcat(this.artist);

        this.album = jobject.get("owner").getAsJsonObject().get("id").toString();
        this.album = mconcat(this.album);

        this.id = mconcat(jobject.get("id").toString());

        this.coverUrl = null;

        this.sampleUrl = null;
    }

    public Track(){}

    private String mconcat(String myString) {
        return myString.substring(1,myString.length() -1);
    }
}