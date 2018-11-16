package com.pugicorn.spotifake_server.entity;

import javax.persistence.*;
import java.io.Serializable;
import java.util.List;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party")
public class Party implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;

    @Column(name = "id_playlist")
    private String idPlaylist;

    @Column(name = "difficulty")
    private int difficulty;

    @Column(name = "auto_generated")
    private boolean autoGenerated;

    @Column(name = "direct")
    private boolean direct;

    @Column(name = "finished")
    private boolean finished;

    @Column(name = "nb_track")
    private int nbTracks;

    @Column(name = "current_track_number")
    private int currentTrackNumber;

    @Column(name = "ownerd")
    private String owner;

    @OneToMany(fetch = FetchType.EAGER, mappedBy = "idParty")
    private List<PartyUser> playerList;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getIdPlaylist() {
        return idPlaylist;
    }

    public void setIdPlaylist(String idPlaylist1) {
        this.idPlaylist = idPlaylist1;
    }

    public int getDifficulty() {
        return difficulty;
    }

    public void setDifficulty(int difficulty) {
        this.difficulty = difficulty;
    }

    public boolean getAutoGenerated() {
        return autoGenerated;
    }

    public void setAutoGenerated(boolean autoGenerated) {
        this.autoGenerated = autoGenerated;
    }

    public boolean getDirect() {
        return direct;
    }

    public void setDirect(boolean direct) {
        this.direct = direct;
    }

    public boolean getFinished() {
        return finished;
    }

    public void setFinished(boolean finished) {
        this.finished = finished;
    }

    public int getCurrentTrackNumber() {
        return currentTrackNumber;
    }

    public String isOwner() {
        return owner;
    }

    public void setOwner(String owner) {
        this.owner = owner;
    }

    public String getOwner() {
        return owner;
    }

    public void setCurrentTrackNumber(int currentTrackNumber) {
        this.currentTrackNumber = currentTrackNumber;
    }

    public List<PartyUser> getPlayerList() {
        return playerList;
    }

    public void setPlayerList(List<PartyUser> playerList) {
        this.playerList = playerList;
    }


    public boolean isDirect() {
        return direct;
    }

    public boolean isFinished() {
        return finished;
    }

    public int getNbTracks() {
        return nbTracks;
    }

    public void setNbTracks(int nbTracks) {
        this.nbTracks = nbTracks;
    }
}