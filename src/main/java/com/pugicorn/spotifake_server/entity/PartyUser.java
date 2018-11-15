package com.pugicorn.spotifake_server.entity;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import java.io.Serializable;

@Entity // This tells Hibernate to make a table out of this class
@Table(name = "party_user")
public class PartyUser implements Serializable {
    @Id
    @Column(name = "idParty")
    private String idParty;

    @Id
    @Column(name = "idUSer")
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