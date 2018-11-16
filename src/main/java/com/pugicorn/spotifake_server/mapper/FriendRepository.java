package com.pugicorn.spotifake_server.mapper;

import com.pugicorn.spotifake_server.entity.Friend;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import java.util.List;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete

public interface FriendRepository extends CrudRepository<Friend, String> {

    @Query("SELECT f FROM Friend f " +
            " WHERE f.user2 = :idUser and f.state='pending' order by f.state")
    List<Friend> findFriendToAccept(@Param("idUser") String idUser);

    @Query("SELECT f FROM Friend f WHERE f.user1 = :idUser")
    List<Friend> findFriends(@Param("idUser") String idUser);

}