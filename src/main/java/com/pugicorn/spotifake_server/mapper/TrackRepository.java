package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.Playlist;
import com.pugicorn.spotifake_server.entity.Track;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface TrackRepository extends CrudRepository<Track, String> {

    @Query("SELECT t FROM Track as t " +
            "LEFT JOIN PlaylistTrack  as pt ON pt.idTrack = t.id WHERE pt.idPlaylist =:idPlaylist ")
    List<Track> findTrackByPlaylist(@Param("id") String idPlaylist);

    @Query("SELECT t.id FROM Track t WHERE t.id IN (:trackId)")
    List<String> findExistedtrackId(@Param("trackId") List<String> trackId);
}