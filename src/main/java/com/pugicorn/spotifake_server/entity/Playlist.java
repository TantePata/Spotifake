package com.pugicorn.spotifake_server.entity;

import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.pugicorn.spotifake_server.controller.UserController;
import com.pugicorn.spotifake_server.mapper.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import java.util.List;
import java.util.Optional;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "playlist")
public class Playlist {

    @Id
    private String id;

    @Column(name = "title")
    private String title;

    @Column(name = "url_image")
    private String urlImage;

    @Column(name = "id_user")
    private String idUser;

    @Column(name = "id_party")
    private String idParty;

    @Column(name = "nb_track")
    private int nbTracks;

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

    public String getUrlImage() {
        return urlImage;
    }

    public void setUrlImage(String urlImage) {
        this.urlImage = urlImage;
    }

    public String getIdUser() {
        return idUser;
    }

    public void setIdUser(String idUser) {
        this.idUser = idUser;
    }

    public String getIdParty() {
        return idParty;
    }

    public void setIdParty(String idParty) {
        this.idParty = idParty;
    }

    public int getNbTracks() {
        return nbTracks;
    }

    public void setNbTracks(int nbTrack) {
        this.nbTracks = nbTrack;
    }

    public Playlist(JsonElement playlist) {

        JsonObject jobject = playlist.getAsJsonObject();
        this.id = jobject.get("id").toString();

        this.title = mconcat(jobject.get("name").toString());

        JsonArray urlImage = jobject.get("images").getAsJsonArray();
        if (urlImage.size() > 0){
            this.urlImage = urlImage.get(0).getAsJsonObject().get("url").toString();
            if (this.urlImage.length() > 3) {
                this.urlImage = this.urlImage.substring(1, this.urlImage.length() - 1);
            }else{
                int i = 42;
            }
        } else {
            this.urlImage = "";
        }

        JsonObject owner = jobject.get("owner").getAsJsonObject();
        if (owner.size()> 0){
            this.idUser = owner.get("id").toString();
            if (this.idUser.length() > 3){
                this.idUser = this.idUser.substring(1, this.idUser.length() - 1);
            } else {
                int i =3;
            }
        }

        JsonObject nbTracks = jobject.get("tracks").getAsJsonObject();
        if (nbTracks.size() > 0){
            this.nbTracks = nbTracks.get("total").getAsInt();
            this.nbTracks = (this.nbTracks > 100 ? 100 : this.nbTracks);
        } else {
            this.nbTracks = 0;
        }

        this.id = mconcat(jobject.get("id").toString());

        this.idParty = null;

    }

    public Playlist(){}

    private String mconcat(String myString) {
        return myString.substring(1,myString.length() - 1);
    }

}