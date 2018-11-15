package com.pugicorn.spotifake_server.entity;

import javax.persistence.*;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "playlist_track")
@IdClass(PlaylistTrack.class)
public class PlaylistTrack implements Serializable {

    @Id
    @Column(name = "id_playlist")
    private String idPlaylist;

    @Id
    @Column(name = "id_track")
    private String idTrack;

    public String getIdPlaylist() {
        return idPlaylist;
    }

    public void setIdPlaylist(String idPlaylist) {
        this.idPlaylist = idPlaylist;
    }

    public String getIdTrack() {
        return idTrack;
    }

    public void setIdTrack(String idTrack) {
        this.idTrack = idTrack;
    }

    public PlaylistTrack(String idPlaylist, String idTrack) {
        this.idPlaylist = idPlaylist;
        this.idTrack = idTrack;
    }

    public PlaylistTrack() {
    }
}