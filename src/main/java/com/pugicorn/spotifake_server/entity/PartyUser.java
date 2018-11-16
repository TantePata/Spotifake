package com.pugicorn.spotifake_server.entity;

import javax.persistence.*;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party_user")
public class PartyUser implements Serializable {
    @Id
    //@ManyToOne(fetch = FetchType.EAGER)
    @JoinColumn(name = "id_party")
    private String idParty;

    @Id
    @Column(name = "id_user")
    private String idUSer;

    public String getIdParty() {
        return idParty;
    }

    public void setIdParty(String idParty) {
        this.idParty = idParty;
    }

    public String getIdUSer() {
        return idUSer;
    }

    public void setIdUSer(String idUSer) {
        this.idUSer = idUSer;
    }
}