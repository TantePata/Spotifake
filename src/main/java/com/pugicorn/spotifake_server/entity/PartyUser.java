package com.pugicorn.spotifake_server.entity;

import org.springframework.beans.factory.annotation.Autowired;

import javax.persistence.*;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party_user")
@IdClass(PartyUser.class)
public class PartyUser implements Serializable {
    @Id
    //@ManyToOne(fetch = FetchType.EAGER)
    @JoinColumn(name = "id_party")
    private int idParty;

    @Id
    @Column(name = "id_user")
    private String idUser;

    public int getIdParty() {
        return idParty;
    }

    public void setIdParty(int idParty) {
        this.idParty = idParty;
    }

    public String getIdUSer() {
        return idUser;
    }

    public void setIdUSer(String idUSer) {
        this.idUser = idUSer;
    }

    public PartyUser(int idParty, String idUser) {
        this.idParty = idParty;
        this.idUser = idUser;
    }

    @Autowired
    public PartyUser() {
    }
}