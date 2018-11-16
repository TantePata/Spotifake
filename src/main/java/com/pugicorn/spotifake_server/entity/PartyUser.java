package com.pugicorn.spotifake_server.entity;

import javax.persistence.*;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party_user")
@IdClass(PartyUser.class)
public class PartyUser implements Serializable {
    @Id
    //@ManyToOne(fetch = FetchType.EAGER)
    @JoinColumn(name = "id_party")
    private String idParty;

    @Id
    @Column(name = "id_user")
    private String idUser;

    public String getIdParty() {
        return idParty;
    }

    public void setIdParty(String idParty) {
        this.idParty = idParty;
    }

    public String getIdUSer() {
        return idUser;
    }

    public void setIdUSer(String idUSer) {
        this.idUser = idUSer;
    }
}