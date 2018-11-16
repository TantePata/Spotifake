package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.PlaylistTrack;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import javax.transaction.Transactional;
import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface PlaylistTrackRepository extends CrudRepository<PlaylistTrack, String> {

    @Modifying
    @Query(value = "insert into playlist_track (id_playlist,id_track) " +
            "SELECT pt.id_playlist, track.id FROM track " +
            "left join playlist_track pt on track.id = pt.id_track" +
            " where pt.id_playlist IN (:playlistId) limit :nb", nativeQuery = true)
    @Transactional
    void addMusicInPlayByNB(@Param("playlistId") List<String> playlistId,
                                    @Param("nb") int nb);
}