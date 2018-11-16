package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.Party;
import com.pugicorn.spotifake_server.entity.Playlist;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface PartyRepository extends CrudRepository<Party, String> {

    @Query("SELECT p.id FROM Party p WHERE p.id IN (:playlistId)")
    List<Party> findExistedPlaylist(@Param("playlistId") List<String> playlistId);
}