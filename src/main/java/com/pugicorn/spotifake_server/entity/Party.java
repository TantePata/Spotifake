package com.pugicorn.spotifake_server.entity;

import javax.persistence.*;
import java.io.Serializable;
import java.util.List;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party")
public class Party implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private String id;

    @Column(name = "id_playlist")
    private String idPlaylist1;

    @Column(name = "difficulty")
    private String difficulty;

    @Column(name = "auto_generated")
    private String autoGenerated;

    @Column(name = "direct")
    private String direct;

    @Column(name = "finished")
    private String finished;

    @Column(name = "current_track_number")
    private String currentTrackNumber;

    @OneToMany(fetch = FetchType.EAGER, mappedBy = "idParty")
    private List<PartyUser> playerList;

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

    public String getAutoGenerated() {
        return autoGenerated;
    }

    public void setAutoGenerated(String autoGenerated) {
        this.autoGenerated = autoGenerated;
    }

    public String getDirect() {
        return direct;
    }

    public void setDirect(String direct) {
        this.direct = direct;
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

    public List<PartyUser> getPlayerList() {
        return playerList;
    }

    public void setPlayerList(List<PartyUser> playerList) {
        this.playerList = playerList;
    }
}