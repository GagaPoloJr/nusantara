DO
$$
BEGIN
    IF EXISTS (SELECT column_name FROM information_schema.columns WHERE table_schema = 'authenticate' AND table_name = 'user_group' AND column_name = 'is_admin') THEN
        ALTER TABLE authenticate.user_group ALTER COLUMN is_admin SET DEFAULT false;
END IF;
END
$$
