package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.Party;
import com.pugicorn.spotifake_server.entity.PartyUser;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface PartyUserRepository extends CrudRepository<PartyUser, String> {

}