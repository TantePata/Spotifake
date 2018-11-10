package com.pugicorn.spotifake_server.entity;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "playlist_track")
public class PlaylistTrack implements Serializable {
    @Id
    @Column(name = "idPlaylist")
    private String idPlaylist;

    @Id
    @Column(name = "idTrack")
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
}