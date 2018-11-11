package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.PlaylistTrack;
import org.springframework.data.repository.CrudRepository;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface PlaylistTrackRepository extends CrudRepository<PlaylistTrack, String> {

}