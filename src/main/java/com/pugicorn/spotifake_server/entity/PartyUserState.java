package com.pugicorn.spotifake_server.entity;

import javax.persistence.*;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party")
public class PartyUserState implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private String id;

    @Column(name = "idParty")
    private String idPlaylist1;

    @Column(name = "idUser")
    private String difficulty;

    @Column(name = "score")
    private String accepted;

    @Column(name = "finished")
    private String finished;

    @Column(name = "current_track_number")
    private String currentTrackNumber;


    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getIdPlaylist1() {
        return idPlaylist1;
    }

    public void setIdPlaylist1(String idPlaylist1) {
        this.idPlaylist1 = idPlaylist1;
    }

    public String getDifficulty() {
        return difficulty;
    }

    public void setDifficulty(String difficulty) {
        this.difficulty = difficulty;
    }

    public String getAccepted() {
        return accepted;
    }

    public void setAccepted(String accepted) {
        this.accepted = accepted;
    }

    public String getFinished() {
        return finished;
    }

    public void setFinished(String finished) {
        this.finished = finished;
    }

    public String getCurrentTrackNumber() {
        return currentTrackNumber;
    }

    public void setCurrentTrackNumber(String currentTrackNumber) {
        this.currentTrackNumber = currentTrackNumber;
    }
}