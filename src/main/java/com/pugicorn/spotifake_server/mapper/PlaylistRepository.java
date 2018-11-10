package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.Playlist;
import com.pugicorn.spotifake_server.entity.User;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface PlaylistRepository extends CrudRepository<Playlist, String> {

    @Query("SELECT p FROM Playlist p WHERE p.title LIKE CONCAT('%',:title,'%')")
    List<Playlist> findPlaylistByTitle(@Param("title") String title);
}